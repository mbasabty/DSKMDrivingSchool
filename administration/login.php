<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    $user_name = $_COOKIE['user_name'];
    $logged_user = $user_name ? $user_name : "Guest";

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
        exit;
    }

    $sql = "SELECT 
        users.user_full_name,
        users.phone,
        users.email,
        user_level.user_level_name
    FROM users
    INNER JOIN user_level 
        ON users.user_level_id = user_level.user_level_id
    ORDER BY users.user_full_name ASC";

    $result = $conn->query($sql);
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

            </div>

            <p class="register-text">
                Don't have an account?
                <a href="/DSKMDrivingSchool/customers/customerRegistration.php">Register</a>
            </p>
            
             <div class="outside-box">
                <a href="/DSKMDrivingSchool/customers/customerBrowse.php">
                    <button type="button">
                        continue to browsing without login
                    </button>
                </a>
            </div>

        </div>
    </div>
</body>
</html>