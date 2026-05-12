<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
    die("Access denied. Please login first.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administration Menu</title>
    <link rel="stylesheet" href="../incl/css/login.css">
</head>

<body>

<div class="login-container">

    <h2>Menu</h2>

    <p class="welcome">
        <b>Welcome <?= htmlspecialchars($_SESSION['name']) ?>!</b>
    </p>

    <p class="menu-title">Please choose an administrative function:</p>

    <div class="button-group">
        <a href="../admin/AdminMenu/SalesDashboard.php">Sales Dashboard</a>
        <a href="../admin/AdminMenu/ViewProducts.php">View Inventory</a>
        <a href="../admin/AdminMenu/ViewStaffDetails.php">View Staff Details</a>
    </div>

</div>

</body>
</html>