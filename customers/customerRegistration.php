<?php
    include_once '../incl/DatabaseConnection/dbconn.php';

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST") {

        $first_name = trim($_POST['first_name']);
        $last_name = trim($_POST['surname']);
        $email = trim($_POST['email_address']);
        $phone = trim($_POST['phone_number']);
        $address = trim($_POST['home_address']);
        $id_number = trim($_POST['id_number']);
        $username = trim($_POST['username']);
        $password_plain = $_POST['password'];

        $license_file = NULL;
        $learners_status = "Pending";
        $date_registered = date("Y-m-d H:i:s");

        $sql = "INSERT INTO student
        (
            first_name,
            last_name,
            username,
            home_address,
            password,
            email,
            phone,
            id_number,
            learners_license_file,
            learners_status,
            date_registered
        )
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $query = $conn->prepare($sql);

        if (!$query) {
            die("Prepare failed: " . $conn->error);
        }

        $query->bind_param(
            "sssssssssss",
            $first_name,
            $last_name,
            $username,
            $address,
            $password_plain,
            $email,
            $phone,
            $id_number,
            $license_file,
            $learners_status,
            $date_registered
        );

        if ($query->execute()) {
            $message = "Registration successful!";
        } else {
            $message = "Insert error: " . $query->error;
        }
        $query->close();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <title>Student Driver Registration</title>
    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/customers/customerReg.css">
</head>

<body>

<div class="register-wrapper">
    <div class="register-header">
        <h1>Register</h1>
        <p>Create your student driver account</p>
    </div>

    <div class="register-box">

        <?php if (!empty($message)): ?>

            <div class="message">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="post">

            <input type="text"
                   name="first_name"
                   placeholder="First Name"
                   required>

            <input type="text"
                   name="surname"
                   placeholder="Last Name"
                   required>

            <input type="email"
                   name="email_address"
                   placeholder="Email Address"
                   required>

            <input type="text"
                   name="phone_number"
                   placeholder="Phone Number">

            <input type="text"
                   name="home_address"
                   placeholder="Home Address">

            <input type="text"
                   name="id_number"
                   placeholder="ID Number"
                   required>

            <input type="text"
                   name="username"
                   placeholder="Username"
                   required>

            <input type="password"
                   name="password"
                   placeholder="Password"
                   required>

            <button type="submit">
                Register
            </button>

        </form>

        <p class="login-text">
            Already have an account?
            <a href="/DSKMDrivingSchool/administration/login.php">
                Login
            </a>
        </p>

    </div>
</div>

</body>
</html>