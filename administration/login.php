<?php
    include_once '../incl/DatabaseConnection/dbconn.php';

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['user_name'];
        $password = $_POST['user_pwd'];

        // Check users table
        $sql = "SELECT * FROM users WHERE user_name = '$username' LIMIT 1";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row['user_pwd']) {
                setcookie("user_id", $row['user_id'], time() + 3600, "/");
                setcookie("user_level_id", $row['user_level_id'], time() + 3600, "/");
                if ($row['user_level_id'] == 1) {
                    header("Location: /DSKMDrivingSchool/administration/adminDasboard.php");
                    exit();
                }
                if ($row['user_level_id'] == 2) {
                    header("Location: instructors.php");
                    exit();
                }
                if ($row['user_level_id'] == 3) {
                    header("Location: ../customers/customerBrowse.php");
                    exit();
                }
            } else {
                $message = "Incorrect password.";
            }
        } else {
            // Check student table
            $sql2 = "SELECT * FROM student WHERE username = '$username' LIMIT 1";
            $result2 = mysqli_query($conn, $sql2);
            if (mysqli_num_rows($result2) > 0) {
                $student = mysqli_fetch_assoc($result2);
                if ($password == $student['password']) {
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
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/customers/login.css">
</head>

<body>

<div class="login-wrapper">

    <div class="login-header">
        <h1>Login</h1>
        <p>Sign in using your credentials</p>
    </div>

    <div class="login-box">
        <?php if (!empty($message)) { ?>
            <p class="error"><?php echo $message; ?></p>
        <?php } ?>
        <form action="login.php" method="POST">

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
    </div>

    <p class="register-text">
        Don't have an account?
        <a href="/DSKMDrivingSchool/customers/customerRegistration.php">
            Register
        </a>
    </p>

    <div class="outside-box">
        <a href="/DSKMDrivingSchool/customers/customerBrowse.php">
            <button type="button">
                Continue browsing without login
            </button>
        </a>
    </div>

</div>

</body>
</html>