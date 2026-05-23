<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    if ($conn->connect_error) {
        echo "Connection failed: " . $conn->connect_error;
        exit;
    }

    $sql = "UPDATE users SET
        user_name = '{$_POST['username']}',
        user_pwd = '{$_POST['password']}',
        user_full_name = '{$_POST['first_name']} {$_POST['last_name']}',
        phone = '{$_POST['phone']}',
        email = '{$_POST['email']}',
        user_level_id = '{$_POST['user_access_id']}'
    WHERE user_id = '{$_POST['staff_id']}'";

    mysqli_query($conn, $sql);
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