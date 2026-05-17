<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
        die("Access denied. Please login first.");
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Instructors Menu</title>
        <link rel="stylesheet" href="../incl/style/administration/instructors.css">
    </head>
    <body>
        <h2>Instructors Menu</h2>
        <!-- SHOW LOGGED IN USER -->
        <p class="welcome">
            <b>Welcome <?= htmlspecialchars($_SESSION['name']) ?> !, what would you like to do?</b>
        </p>
        <!-- ONLY BUTTONS INSIDE -->
        <div class="page-container">
            <div class="button-group">
                <a href="#">
                    VIEW ASSIGNED DRIVERS
                </a>
                <a href="#">
                    VIEW HISTORY
                </a>
            </div>
        </div>
    </body>
</html>