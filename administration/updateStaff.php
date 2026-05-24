<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include_once "../incl/DatabaseConnection/dbConn.php";

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $message = "";
    $doneButton = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_id = $_POST['staff_id'];

        // Get existing record
        $existing = $conn->query("SELECT * FROM users WHERE user_id = '$user_id'");
        $row = $existing->fetch_assoc();

        if (!$row) {
            exit("Invalid Staff ID");
        }

        // First name
        $first_name = $_POST['first_name'];
        if (empty($first_name)) {
            $first_name = explode(" ", $row['user_full_name'])[0];
        }

        // Last name
        $last_name = $_POST['last_name'];
        if (empty($last_name)) {
            $parts = explode(" ", $row['user_full_name']);
            $last_name = isset($parts[1]) ? $parts[1] : "";
        }

        $full_name = $first_name . " " . $last_name;

        // Username
        $username = $_POST['username'];
        if (empty($username)) {
            $username = $row['user_name'];
        }

        // Password
        $password = $_POST['password'];
        if (empty($password)) {
            $password = $row['user_pwd'];
        }

        // Phone
        $phone = $_POST['phone'];
        if (empty($phone)) {
            $phone = $row['phone'];
        }

        // Email
        $email = $_POST['email'];
        if (empty($email)) {
            $email = $row['email'];
        }

        // Access level
        $user_access_id = $_POST['user_access_id'];
        if (empty($user_access_id)) {
            $user_access_id = $row['user_level_id'];
        }

        // UPDATE QUERY
        $result = $conn->query("UPDATE users SET
            user_name = '$username',
            user_pwd = '$password',
            user_full_name = '$full_name',
            phone = '$phone',
            email = '$email',
            user_level_id = '$user_access_id'
            WHERE user_id = '$user_id'
        ");

        if ($result === TRUE) {
            $message = "Staff updated successfully.";

            $doneButton = "
                <br><br>
                <a href='/DSKMDrivingSchool/administration/Staff.php'>
                    <button type='button' style='padding:10px 20px; background:green; color:white; border:none; cursor:pointer;'>
                        Done
                    </button>
                </a>
            ";
        } else {
            $message = "Update failed: " . $conn->error;
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Staff - DSKM Driving School</title>
    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/administration/updateStaff.css"/>
</head>

<body>

<div class="register-wrapper">

    <div class="register-header">
        <h1>Update Staff</h1>
        <p>Enter Staff ID and update fields (leave blank to keep existing values)</p>

        <?php if (!empty($message)) { ?>
            <p style="color:green;">
                <?php echo $message; ?>
            </p>

            <?php echo $doneButton; ?>
        <?php } ?>

    </div>
    <div class="register-box">
        <form method="post">
            <input type="number" name="staff_id" placeholder="Staff ID" required><br><br>
            <input type="text" name="first_name" placeholder="First Name"><br><br>
            <input type="text" name="last_name" placeholder="Last Name"><br><br>
            <input type="text" name="username" placeholder="Username"><br><br>
            <input type="text" name="password" placeholder="Password"><br><br>
            <input type="text" name="phone" placeholder="Contact Number"><br><br>
            <input type="email" name="email" placeholder="Email Address"><br><br>
            <input type="number" name="user_access_id" placeholder="User Access ID"><br><br>
            <input type="submit" value="Update Staff"><br><br>

        </form>

    </div>
    <br>

        <a href="/DSKMDrivingSchool/administration/staff.php">
            <button type="button">BACK</button>
        </a>
</div>

</body>
</html>