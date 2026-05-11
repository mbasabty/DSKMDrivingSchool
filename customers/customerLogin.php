<?php
include_once '../incl/DatabaseConnection/dbconn.php';

session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = trim($_POST['user_name']);
    $password = $_POST['user_pwd'];

    $sql = "SELECT student_id, username, password 
            FROM student 
            WHERE username = ? 
            LIMIT 1";

    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Database error: " . $conn->error);
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

        // ✅ FIXED: plain text comparison
        if ($password === $row['password']) {

            $_SESSION['logged'] = true;
            $_SESSION['student_id'] = $row['student_id'];
            $_SESSION['username'] = $row['username'];

            header("Location: ../customers/customerBrowse.php");
            exit();

        } else {
            $message = "Incorrect password.";
        }

    } else {
        $message = "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Driver Login</title>
</head>

<body>

<h2>Student Driver Login</h2>

<?php if (!empty($message)): ?>
    <p style="color:red;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<form method="post">

    <input type="text" name="user_name" placeholder="Username" required><br><br>

    <input type="password" name="user_pwd" placeholder="Password" required><br><br>

    <input type="submit" value="Login">

</form>

<p>
    Don't have an account?
    <a href="customerRegistration.php">Register</a>
</p>

</body>
</html>