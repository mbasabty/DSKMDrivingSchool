<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    $message = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['user_id'])) {
        $id = $_POST['user_id'];
        $sql = "DELETE FROM users WHERE user_id = '$id'";

        if ($conn->query($sql)) {
            $message = "User deleted successfully.";
        } else {
            $message = "Delete failed: " . $conn->error;
        }
    }

    $result = $conn->query("SELECT * FROM users ORDER BY user_full_name ASC");
    $conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Delete Users - DSKM Driving School</title>
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

        <?php if ($message != "") { ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php } ?>

        <?php while ($row = $result->fetch_assoc()) { ?>

            <div style="border:1px solid #ddd; padding:15px; margin-bottom:15px; border-radius:10px;">

                <h3><?php echo $row['user_full_name']; ?></h3>

                <p><b>Username:</b> <?php echo $row['user_name']; ?></p>
                <p><b>Phone:</b> <?php echo $row['phone']; ?></p>
                <p><b>Email:</b> <?php echo $row['email']; ?></p>

                <form method="post">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id']; ?>">
                    <button type="submit">Delete User</button>
                </form>

            </div>

        <?php } ?>

        <br>

        <a href="/DSKMDrivingSchool/administration/adminDasboard.php">
            <button type="button">HOME</button>
        </a>

    </div>

</div>

</body>
</html>