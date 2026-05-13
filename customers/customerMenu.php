<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    header("Location: ../customerLogin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Driver Menu</title>

    <link rel="stylesheet" href="../incl/style/customers/customerMenu.css">
</head>

<body>

    <h2>Menu</h2>

    <!-- SHOW LOGGED IN USER -->
    <p class="welcome">
        Welcome,
        <b>
            <?= ucfirst(htmlspecialchars($_SESSION['username'] ?? 'User')) ?>
        </b>
        — the journey starts here
    </p>

    <!-- ONLY BUTTONS INSIDE -->
    <div class="page-container">

        <div class="button-group">

            <a href="customerBrowse.php">
                Book your Lessons
            </a>

            <a href="#">
                Learner's License Test Prep
            </a>

            <a href="licenseTestHelp.php">
                Driver’s License Test Assistance
            </a>

        </div>

    </div>

</body>
</html>