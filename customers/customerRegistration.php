<?php
include_once '../incl/DatabaseConnection/dbconn.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get form data
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $email = $_POST['email_address'];
    $phone = $_POST['phone_number'];
    $address = $_POST['home_address'];
    $id_number = $_POST['id_number'];
    $username = $_POST['username'];

    // Hash password
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO customerLogin
            (
                first_name,
                surname,
                email_address,
                phone_number,
                home_address,
                id_number,
                username,
                password_hash
            )
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param(
        "ssssssss",
        $first_name,
        $surname,
        $email,
        $phone,
        $address,
        $id_number,
        $username,
        $password
    );

    if ($stmt->execute()) {

        $message = "Registration successful!";

    } else {

        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration</title>
</head>

<body>

<h2>Customer Registration</h2>

<?php
if ($message != "") {
    echo "<p>$message</p>";
}
?>

<form action="" method="post">

    <input type="text" name="first_name" placeholder="First Name" required><br><br>

    <input type="text" name="surname" placeholder="Surname" required><br><br>

    <input type="email" name="email_address" placeholder="Email Address" required><br><br>

    <input type="text" name="phone_number" placeholder="Phone Number"><br><br>

    <input type="text" name="home_address" placeholder="Home Address"><br><br>

    <input type="text" name="id_number" placeholder="ID Number" required><br><br>

    <input type="text" name="username" placeholder="Username" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <input type="submit" value="Register">

</form>

<p>
    Already have an account?
    <a href="customerLogin.php">Login</a>
</p>

</body>
</html>