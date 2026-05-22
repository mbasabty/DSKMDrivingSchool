<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $user_name = trim($_POST['user_name']);
        $user_pwd = trim($_POST['user_pwd']);
        $user_full_name = trim($_POST['user_full_name']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $user_level_id = trim($_POST['user_level_id']);

        $sql = "INSERT INTO `users`
        (
            user_name,
            user_pwd,
            user_full_name,
            phone,
            email,
            user_level_id
        )
        VALUES (?, ?, ?, ?, ?, ?)";

        $query = $conn->prepare($sql);

        if ($query === false) {

            die("SQL Error: " . $conn->error);

        }

        $query->bind_param(
            "sssssi",
            $user_name,
            $user_pwd,
            $user_full_name,
            $phone,
            $email,
            $user_level_id
        );

        if ($query->execute()) {
            $message = "User registered successfully!";
        } else {
            $message = "Execute Error: " . $query->error;
        }

        // ONLY CLOSE IF QUERY EXISTS
        if ($query instanceof mysqli_stmt) {
            $query->close();
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