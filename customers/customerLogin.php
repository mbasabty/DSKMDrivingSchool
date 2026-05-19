<?php
    include_once '../incl/DatabaseConnection/dbconn.php';
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['user_name'];
        $password = $_POST['user_pwd'];

        $sql = "SELECT * FROM student WHERE username='$username'";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($password == $row['password']) {
                // Save user data in cookies
                setcookie("logged", "yes", time() + 3600, "/");
                setcookie("student_id", $row['student_id'], time() + 3600, "/");
                setcookie("username", $row['username'], time() + 3600, "/");
                header("Location: ../customers/customerMenu.php");
                exit();
            } else {
                $message = "Incorrect password.";
            }
        } else {
            $message = "User not found.";
        }
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
    <div class="login-header">
        <h1>Student Driver Login</h1>
        <p>Sign in to continue your journey</p>
    </div>
    <div class="login-box">
        <?php
            if ($message != "") {
                echo "<p class='error'>$message</p>";
            }
        ?>
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