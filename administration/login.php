<?php
include_once '../incl/DatabaseConnection/dbconn.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['user_name']);
    $password = trim($_POST['user_pwd']);

    // ---------------- USERS TABLE ----------------
    $sqlUsers = "SELECT user_id, user_name, user_pwd, user_full_name, user_level_id
                 FROM users
                 WHERE user_name = ?
                 LIMIT 1";

    $stmtUsers = $conn->prepare($sqlUsers);

    $stmtUsers->bind_param("s", $username);
    $stmtUsers->execute();

    $resultUsers = $stmtUsers->get_result();

    if ($row = $resultUsers->fetch_assoc()) {

        if ($password === $row['user_pwd']) {

            setcookie("user_id", $row['user_id'], time() + 3600, "/");
            setcookie("user_level_id", $row['user_level_id'], time() + 3600, "/");

            if ($row['user_level_id'] == 1) {
                header("Location: adminMenu.php");
                exit();
            } elseif ($row['user_level_id'] == 2) {
                header("Location: instructors.php");
                exit();
            } elseif ($row['user_level_id'] == 3) {
                header("Location: ../customers/customerBrowse.php");
                exit();
            }

        } else {
            $message = "Incorrect password.";
        }

    } else {

        // ---------------- STUDENT TABLE ----------------
        $sqlStudent = "SELECT student_id, username, password, user_level_id
                       FROM student
                       WHERE username = ?
                       LIMIT 1";

        $stmtStudent = $conn->prepare($sqlStudent);
        $stmtStudent->bind_param("s", $username);
        $stmtStudent->execute();

        $resultStudent = $stmtStudent->get_result();

        if ($student = $resultStudent->fetch_assoc()) {

            if ($password === $student['password']) {

                // ✅ SET COOKIE HERE (THIS FIXES YOUR ERROR)
                setcookie("student_id", $student['student_id'], time() + 3600, "/");
                setcookie("user_level_id", $student['user_level_id'], time() + 3600, "/");

                if ($student['user_level_id'] == 3) {
                    header("Location: /DSKMDrivingSchool/customers/customerBrowse.php");
                    exit();
                } else {
                    header("Location: studentMenu.php");
                    exit();
                }

            } else {
                $message = "Incorrect password.";
            }

        } else {
            $message = "User not found.";
        }

        $stmtStudent->close();
    }

    $stmtUsers->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../incl/style/customers/login.css">
</head>

<body>

    <div class="login-wrapper">

        <div class="login-header">
            <h1>Login</h1>
            <p>Sign in using your user or admin credentials</p>
        </div>

        <div class="login-box">

            <?php if (!empty($message)): ?>
                <p class="error">
                    <?= htmlspecialchars($message) ?>
                </p>
            <?php endif; ?>

            <form action="login.php" method="post">

                <input 
                    type="text" 
                    name="user_name" 
                    placeholder="Username" 
                    required
                >

                <input 
                    type="password" 
                    name="user_pwd" 
                    placeholder="Password" 
                    required
                >

                <button type="submit">
                    Login
                </button>

            </form>

            <p class="register-text">
            Don't have an account?
            <a href="/DSKMDrivingSchool/customers/customerRegistration.php">Register</a>
            </p>

        </div>
    </div>
</body>
</html>