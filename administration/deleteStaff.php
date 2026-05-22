<?php
include_once "../incl/DatabaseConnection/dbConn.php";

$message = "";

// DELETE USER
if (array_key_exists('user_id', $_POST)) {

    $id = (int) $_POST['user_id'];

    $deleteQuery = $conn->prepare("DELETE FROM `user` WHERE user_id = ?");

    if ($deleteQuery) {
        $deleteQuery->bind_param("i", $id);
        if ($deleteQuery->execute()) {
            $message = "User deleted successfully.";
        } else {

            $message = "Could not delete user.";
        }
        $deleteQuery->close();
    } else {

        $message = "Database error: " . $conn->error;

    }
}

// LOAD USERS
$staffResult = $conn->query("
    SELECT *
    FROM `user`
    ORDER BY user_full_name ASC
");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Staff</title>
    <link rel="stylesheet" href="/DSKMDrivingSchool/incl/style/administration/deleteStaff.css">
</head>

<body>

<div class="register-wrapper">

    <div class="register-header">
        <h1>Remove Staff</h1>
        <p>Select a staff member to delete</p>
    </div>

    <div class="register-box">

        <?php if (!empty($message)): ?>

            <div class="message">
                <?= htmlspecialchars($message) ?>
            </div>

        <?php endif; ?>

        <?php if ($staffResult && $staffResult->num_rows > 0): ?>

            <?php while ($user = $staffResult->fetch_assoc()): ?>

                <div class="staff-card">

                    <h3>
                        <?= htmlspecialchars($user['first_name']) ?>
                        <?= htmlspecialchars($user['last_name']) ?>
                    </h3>

                    <p>
                        <strong>Username:</strong>
                        <?= htmlspecialchars($user['user_name']) ?>
                    </p>

                    <p>
                        <strong>Phone:</strong>
                        <?= htmlspecialchars($user['phone']) ?>
                    </p>

                    <p>
                        <strong>Email:</strong>
                        <?= htmlspecialchars($user['email']) ?>
                    </p>

                    <form method="post">

                        <input type="hidden"
                               name="staff_id"
                               value="<?= $user['staff_id'] ?>">

                        <button type="submit">
                            Delete Staff Member
                        </button>

                    </form>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <p>No staff members found.</p>

        <?php endif; ?>

        <p class="login-text">
            <a href="../updateStaff.php">
                Back to Update Staff
            </a>
        </p>

    </div>

</div>

</body>
</html>