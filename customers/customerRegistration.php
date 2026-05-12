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

    // Hash password
    $password_hash = password_hash($password_plain, PASSWORD_DEFAULT);

    // Default values for missing fields
    $license_file = NULL;
    $learners_status = "Pending";
    $date_registered = date("Y-m-d H:i:s");

    // Insert query (MATCHES YOUR TABLE EXACTLY)
    $sql = "INSERT INTO student
    (
        first_name,
        last_name,
        username,
        password,
        email,
        phone,
        id_number,
        learners_license_file,
        learners_status,
        date_registered
    )
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param(
        "ssssssssss",
        $first_name,
        $last_name,
        $username,
        $password_hash,
        $email,
        $phone,
        $id_number,
        $license_file,
        $learners_status,
        $date_registered
    );

    if ($stmt->execute()) {
        $message = "Registration successful!";
    } else {
        $message = "Insert error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Driver Registration</title>
</head>

<body>

<h2>Student Driver Registration</h2>

<?php if (!empty($message)): ?>
    <p><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">

    <input type="text" name="first_name" placeholder="First Name" required><br><br>

    <input type="text" name="surname" placeholder="Last Name" required><br><br>

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