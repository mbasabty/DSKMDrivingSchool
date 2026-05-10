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