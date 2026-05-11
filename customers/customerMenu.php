<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("Location: ../customerLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Student Driver Menu</title>
    <link rel="stylesheet" href="../incl/css/login.css">
</head>

<body>

<div class="login-container">

    <h2>Menu</h2>

    <!-- 👇 SHOW LOGGED IN USER -->
    <p class="welcome">
        Logged in as: 
        <b>
            <?= htmlspecialchars($_SESSION['username'] ?? 'User') ?>
        </b>
    </p>

    <p class="menu-title">Please choose an administrative function:</p>

    <div class="button-group">
        <a href="customerBrowse.php">Book your Lessons</a>
        <a href=".php">Driver’s License Test Assistance</a>
    </div>

</div>

</body>
</html>