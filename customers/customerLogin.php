<?php
include_once '../incl/DatabaseConnection/dbconn.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['user_name'];
    $password = $_POST['user_pwd'];

    // Check user
    $sql = "SELECT * FROM customerLogin WHERE username = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password_hash'])) {

            // Create cookies
            setcookie("logged", "1", time() + 3600, "/");
            setcookie("customer_id", $row['customer_id'], time() + 3600, "/");
            setcookie("username", $row['username'], time() + 3600, "/");

            // Redirect
            header("Location: ../customers/placeOrder.php");
            exit();

        } else {
            $message = "Incorrect password.";
        }

    } else {
        $message = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Driver Login</title>
</head>

<body>

<h2>Student Driver Login</h2>

<?php
if ($message != "") {
    echo "<p style='color:red;'>$message</p>";
}
?>

<form action="" method="post">

    <input type="text" name="user_name" placeholder="Username" required><br><br>

    <input type="password" name="user_pwd" placeholder="Password" required><br><br>

    <input type="submit" value="Login">

</form>

<p>
    Don't have an account?
    <a href="customerRegistration.php">Register</a>
    <a href="customerBrowse.php">NEXT PAGE</a>
</p>

</body>
</html>