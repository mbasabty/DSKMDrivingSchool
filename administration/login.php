<?php
include_once '../incl/DatabaseConnection/dbconn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['user_name']);
    $password = trim($_POST['user_pwd']);

    $sql = "SELECT user_id, user_name, user_pwd, user_full_name, user_level_id 
            FROM users 
            WHERE user_name = ? 
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        // Check password
        if ($password === $row['user_pwd']) {

            // Sessions
            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['level'] = $row['user_level_id'];
            $_SESSION['name'] = $row['user_full_name'];

            // Cookies (valid for 1 hour)
            setcookie("user_id", $row['user_id'], time() + 3600, "/");
            setcookie("user_name", $row['user_full_name'], time() + 3600, "/");
            setcookie("user_level", $row['user_level_id'], time() + 3600, "/");

            // Redirect based on user level
            if ($row['user_level_id'] == 1) {

                header("Location: adminMenu.php");
                exit();
                

            } elseif ($row['user_level_id'] == 2) {

                header("Location: instructors.php");
                exit();

            } else {

                header("Location: menu.php");
                exit();
            }

        } else {

            echo "Incorrect password.";
        }

    } else {

        echo "User not found.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Administration Login</title>

    <link rel="stylesheet" href="../incl/style/administration/adminLogin.css">
</head>

<body>

<div class="login-wrapper">

    <!-- PAGE HEADING -->
    <div class="login-header">
        <h1>Administration Login</h1>
        <p>Please enter your staff details to login</p>
        
    </div>

    <!-- LOGIN CARD -->
    <div class="login-box">

        <?php if (!empty($message)): ?>
            <p class="error"><?= htmlspecialchars($message) ?></p>
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

            <button type="submit">Login</button>

        </form>

        <p class="register-text">
            <a href="#">Forgot password?</a>
        </p>

    </div>

</div>

</body>
</html>