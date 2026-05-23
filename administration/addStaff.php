<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    $message = "";
    $doneButton = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $user_name = $_POST['user_name'];
        $user_pwd = $_POST['user_pwd'];
        $user_full_name = $_POST['user_full_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $user_level_id = $_POST['user_level_id'];

        if ($user_level_id == "") {
            $user_level_id = 0; 
        }

        $result = $conn->query("INSERT INTO users
            (user_name, user_pwd, user_full_name, phone, email, user_level_id)
            VALUES
            ('$user_name', '$user_pwd', '$user_full_name', '$phone', '$email', '$user_level_id')");

        if ($result === TRUE) {
            $message = "User registered successfully!";

            $doneButton = "
                <br><br>
                <a href='/DSKMDrivingSchool/administration/Staff.php'>
                    <button type='button' style='padding:10px 20px; background:green; color:white; border:none; cursor:pointer;'>
                        Done
                    </button>
                </a>
            ";

        } else {

            if ($conn->errno === 1062) {
                $message = "Registration failed: User already exists.";
            } else {
                $message = "Registration failed: " . $conn->error;
            }
        }

        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Staff - DSKM Driving School</title>
    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="/DSKMDrivingSchool/incl/style/administration/addStaff.css"/>
</head>

<body>

<div class="register-wrapper">

    <div class="register-header">
        <h1>New Staff</h1>
        <p>Add a new staff</p>
    </div>

    <div class="register-box">

        <?php if (!empty($message)) { ?>
            <div class="message">
                <?php echo $message; ?>
            </div>

            <?php echo $doneButton; ?>
        <?php } ?>

        <form method="post">

            <input type="text" name="user_full_name" placeholder="Full Name" required>
            <input type="text" name="user_name" placeholder="Username" required>
            <input type="password" name="user_pwd" placeholder="Password" required>
            <input type="text" name="phone" placeholder="Phone Number">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="number" name="user_level_id" placeholder="User Level ID" required>

            <button type="submit">Register User</button>

        </form>

    </div>

</div>

</body>
</html>