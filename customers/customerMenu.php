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
    <link rel="stylesheet" href="../incl/style/customers/customerMenu.css">
</head>

<body>

<div class="page-container">

    <h2>Menu</h2>

    <!-- SHOW LOGGED IN USER -->
    <p class="welcome">
        Welcome,
        <b>
            <?= ucfirst(htmlspecialchars($_SESSION['username'] ?? 'User')) ?>
        </b>
        the journey starts here
    </p>

    <div class="login-container">
        <p class="menu-title">Please choose an option:</p>

        <div class="button-group">
            <a href="customerBrowse.php">Book your Lessons</a>
            <a href="licenseTestHelp.php">Driver’s License Test Assistance</a>
        </div>
    </div>

</div>

</body>
</html>