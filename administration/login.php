<?php
include_once '../incl/DatabaseConnection/dbconn.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['user_name'];
    $password = $_POST['user_pwd'];

    $sql = "SELECT user_id, user_name, user_pwd, user_full_name, user_level_id 
            FROM users 
            WHERE user_name = ? 
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {

    
        if ($password === $row['user_pwd']) {

            $_SESSION['logged'] = true;
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['level'] = $row['user_level_id'];
            $_SESSION['name'] = $row['user_full_name'];

            header("Location: menu.php");
            exit();

        } else {
            echo "Incorrect password.";
        }

    } else {
        echo "User not found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Administration</title>
    <meta charset="UTF-8">
</head>

<body>

    <h1>Administration</h1>
    <p>Please log in to continue.</p>

    <form action="login.php" method="post">

        <label>Username:</label><br>
        <input type="text" name="user_name" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="user_pwd" required><br><br>

        <input type="submit" value="Log In">

    </form>
    <P><a href="menu.php">next page</a></P>

</body>
</html> 