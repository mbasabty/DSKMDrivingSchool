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
        <title>Administration Menu</title>
        <link rel="stylesheet" href="../incl/style/administration/adminMenu.css">
    </head>

    <body>
        <h2>Menu</h2>
        <!-- SHOW LOGGED IN USER -->
        <p class="welcome">
            <b>Welcome <?= htmlspecialchars($_SESSION['name']) ?> !, what would you like to do?</b>
        </p>
        <!-- ONLY BUTTONS INSIDE -->
        <div class="page-container">
            <div class="button-group">
                <a href="#">
                    SALES DASHBOARD
                </a>
                <a href="Staff.php">
                     STAFF DETAILS
                </a>
                <a href="StudentBookings.php">
                     STUDENT BOOKINGS
                </a>
            </div>
        </div>
    </body>
</html>