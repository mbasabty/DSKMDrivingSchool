<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Administration Menu</title>
    <link rel="stylesheet" href="../incl/css/login.css">
    <link rel="icon" type="image/png" href="../incl/images/logo.png">
</head>

<body>

    <div class="login-container">

        <h1>Administration Menu</h1>

        <!-- 
        <?php
            // include_once '../incl/DatabaseConnection/dbconn.php';

            // $sql = "SELECT * 
            //         FROM user 
            //         WHERE user_name = '$_POST[user_name]' 
            //         AND user_pwd = '$_POST[user_pwd]'";

            // $result = $conn->query($sql);

            // if ($result) {

            //     if ($result->num_rows == 1) {

            //         $row = $result->fetch_assoc();

            //         setcookie("level", $row["user_level_id"]);
            //         setcookie("logged", 1);

            //         echo "<p><b>Welcome {$row['user_full_name']}!</b></p>";

            //         mysqli_free_result($result);

            //     } else {

            //         echo "<p><b>Login failure.</b></p>";

            //     }
            // } else {

            //     echo "<p>{$conn->error}</p>";

            // }
        ?>
        -->

        <p><b>Welcome Admin!</b></p>

        <p>Please choose an administrative function:</p>

        <div class="button-group">

            <a href="SalesDashboard.html" class="btn btn-add">
                Sales Dashboard
            </a>

            <br><br>

            <a href="ViewBookings.html" class="btn btn-add">
                View Bookings
            </a>

            <br><br>

            <a href="ViewStaffDetails.html" class="btn btn-add">
                View Staff Details
            </a>


            <br><br>
            
            <a href="ViewStaffDetails.html" class="btn btn-add">
                Services
            </a>

        </div>

        <br>

        <a href="index.php">
            Log Out
        </a>

    </div>

</body>
</html>