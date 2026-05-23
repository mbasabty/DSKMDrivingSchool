<?php

include_once "../incl/DatabaseConnection/dbConn.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from form
$staff_id = $_POST['staff_id'];

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$username = $_POST['username'];
$password = $_POST['password'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$user_access_id = $_POST['user_access_id'];

// Combine full name
$full_name = $first_name . " " . $last_name;

// SQL UPDATE
$sql = "UPDATE users SET
        user_name='$username',
        user_pwd='$password',
        user_full_name='$full_name',
        phone='$phone',
        email='$email',
        user_level_id='$user_access_id'
        WHERE user_id='$staff_id'";

// Run query
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Staff</title>

    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">

    <link rel="stylesheet"
          href="../incl/style/administration/updateStaff.css"/>
</head>

<body>

<div class="register-wrapper">

    <div class="register-header">
        <h1>Update Staff</h1>

        <p>
            Enter Staff ID and fill in the fields you would like to update
        </p>

        <?php
            if ($result) {
                echo "<p style='color:green;'>
                        Staff updated successfully
                      </p>";
            } else {
                echo "<p style='color:red;'>
                        Error: " . mysqli_error($conn) . "
                      </p>";
            }
        ?>
    </div>

    <div class="register-box">

        <form action="updateStaff.php" method="post">

            <p>

                <input type="number"
                       name="staff_id"
                       placeholder="Staff ID"
                       required><br><br>

                <input type="text"
                       name="first_name"
                       placeholder="First Name"><br><br>

                <input type="text"
                       name="last_name"
                       placeholder="Last Name"><br><br>

                <input type="text"
                       name="username"
                       placeholder="Username"><br><br>

                <input type="text"
                       name="password"
                       placeholder="Password"><br><br>

                <input type="text"
                       name="phone"
                       placeholder="Contact Number"><br><br>

                <input type="email"
                       name="email"
                       placeholder="Email Address"><br><br>

                <input type="number"
                       name="user_access_id"
                       placeholder="User Access Level"><br><br>

                <input type="submit"
                       value="Update Staff"><br><br>

            </p>

        </form>

    </div>

</div>

</body>
</html>

<?php
$conn->close();
?>