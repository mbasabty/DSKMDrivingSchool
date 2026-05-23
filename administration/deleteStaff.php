<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    $message = "";

    /* DELETE USER */
    if ($_POST['user_id']) {
        $id = $_POST['user_id'];
        $sql = "DELETE FROM users WHERE user_id = '$id'";
        $conn->query($sql);
        $message = "User deleted successfully.";
    }

    /* LOAD USERS */
    $result = $conn->query("SELECT * FROM users ORDER BY user_full_name ASC");

    if (!$result) {
        echo "SQL Error: " . $conn->error;
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Users</title>
    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/administration/addStaff.css"/>
</head>

<body>

<div class="register-wrapper">

    <div class="register-header">
        <h1>Delete Users</h1>
        <p>Select a user to remove</p>
    </div>

    <div class="register-box">

        <?php if (!empty($message)): ?>
            <div class="message">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <?php while ($row = $result->fetch_assoc()): ?>

            <div style="border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:10px;">

                <h3><?= htmlspecialchars($row['user_full_name']) ?></h3>

                <p><b>Username:</b> <?= htmlspecialchars($row['user_name']) ?></p>
                <p><b>Phone:</b> <?= htmlspecialchars($row['phone']) ?></p>
                <p><b>Email:</b> <?= htmlspecialchars($row['email']) ?></p>

                <form method="post">

                    <input type="hidden"
                           name="user_id"
                           value="<?= $row['user_id'] ?>">

                    <button type="submit">
                        Delete Staff
                    </button>

                </form>

            </div>

        <div class="outside-box">
            <a href="/DSKMDrivingSchool/administration/adminDasboard.php">
                <button type="button">
                 HOME
                </button>
            </a>
        </div>
        <?php endwhile; ?>
    </div>

</div>

</body>
</html>