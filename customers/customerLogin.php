<?php
session_start();
include_once '../incl/DatabaseConnection/dbconn.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['user_name']);
    $password = $_POST['user_pwd'];

    $sql = "SELECT student_id, username, password 
            FROM student 
            WHERE username = ? 
            LIMIT 1";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Database error: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        if ($password === $row['password']) {

            $_SESSION['logged'] = true;
            $_SESSION['student_id'] = $row['student_id'];
            $_SESSION['username'] = $row['username'];

            header("Location: ../customers/customerMenu.php");
            exit();

        } else {
            $message = "Incorrect password.";
        }

    } else {
        $message = "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Student Driver Login</title>

    <link rel="stylesheet" href="../incl/style/customers/customerLogin.css">
</head>

<body>

<div class="login-wrapper">

    <!-- PAGE HEADING -->
    <div class="login-header">
        <h1>Student Driver Login</h1>
        <p>Sign in to continue your journey</p>
    </div>

    <!-- LOGIN CARD -->
    <div class="login-box">

        <?php if (!empty($message)): ?>
            <p class="error"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="post">

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

            <button type="submit">Login</button>

        </form>

        <p class="register-text">
            Don't have an account?
            <a href="customerRegistration.php">Register</a>
        </p>

    </div>

</div>

</body>
</html>