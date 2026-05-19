<?php
    include_once '../incl/DatabaseConnection/dbconn.php';
    $message = "";
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $username = trim($_POST['user_name']);
        $password = trim($_POST['user_pwd']);

        $sqlQuery = "SELECT user_id,
                       user_name, 
                       user_pwd, 
                       user_full_name, 
                       user_level_id 
                FROM users 
                WHERE user_name = ? 
                LIMIT 1";

        $sql = $conn->prepare($sqlQuery);
        $sql->bind_param("s", $username);
        $sql->execute();

        $result = $sql->get_result();
        if ($row = $result->fetch_assoc()) {
            // CHECK PASSWORD
            if ($password === $row['user_pwd']) {
                // REDIRECT BASED ON USER LEVEL
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
                $message = "Incorrect password.";
            }
        } else {
            $message = "User not found.";
        }
        $sql->close();
        $sql->close();
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
                <a href="#">Forgot password?</a>
            </p>
        </div>
    </div>
</body>
</html>