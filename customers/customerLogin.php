<!DOCTYPE html>
<html>
<head>
    <title>Student Driver Login</title>
    <link rel="stylesheet" href="../incl/style/customers/customerLogin.css">
</head>

<body>

<div class="login-wrapper">

    <!-- OUTSIDE THE BOX (page heading) -->
    <div class="login-header">
        <h1>Student Driver Login</h1>
        <p>Sign in to continue your journey</p>
    </div>

    <!-- LOGIN CARD (the box) -->
    <div class="login-box">

        <?php if (!empty($message)): ?>
            <p class="error"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>

        <form method="post">

            <input type="text" name="user_name" placeholder="Username" required>

            <input type="password" name="user_pwd" placeholder="Password" required>

            <button type="submit">Login</button>

        </form>

        <p class="register-text">
            Don't have an account?
            <a href="customerRegistration.php">Register</a>
        </p>

    </div>

</div>

</body>
</html>