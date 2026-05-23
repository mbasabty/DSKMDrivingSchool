<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    if ($_POST) {

        $user_name = $_POST['user_name'];
        $user_pwd = $_POST['user_pwd'];
        $user_full_name = $_POST['user_full_name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $user_level_id = $_POST['user_level_id'];

        $sql = "INSERT INTO users 
                (user_name, user_pwd, user_full_name, phone, email, user_level_id)
                VALUES (
                    '$user_name',
                    '$user_pwd',
                    '$user_full_name',
                    '$phone',
                    '$email',
                    '$user_level_id'
                )";

        if ($conn->query($sql)) {
            echo "User registered successfully!";
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
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

            <?php if (!empty($message)): ?>

                <div class="message">
                    <?= htmlspecialchars($message) ?>
                </div>

            <?php endif; ?>

            <form method="post">

                <input type="text"
                    name="user_full_name"
                    placeholder="Full Name"
                    required>

                <input type="text"
                    name="user_name"
                    placeholder="Username"
                    required>

                <input type="password"
                    name="user_pwd"
                    placeholder="Password"
                    required>

                <input type="text"
                    name="phone"
                    placeholder="Phone Number">

                <input type="email"
                    name="email"
                    placeholder="Email Address"
                    required>

                <input type="number"
                    name="user_level_id"
                    placeholder="User Level ID"
                    required>

                <button type="submit">
                    Register User
                </button>
            </form>
        </div>
    </div>
</body>
</html>