<?php
// Database connection
include_once "../incl/DatabaseConnection/dbConn.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch staff details
$sql = "SELECT 
            users.user_full_name,
            users.phone,
            users.email,
            user_level.user_level_name
        FROM users
        INNER JOIN user_level 
        ON users.user_level_id = user_level.user_level_id
        ORDER BY users.user_full_name ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Staff Details</title>
</head>
<body>

<h2>Staff Table</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Staff Full Name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Position</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['user_full_name']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['user_level_name']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No records found</td></tr>";
    }

    $conn->close();
    ?>

</table>

</body>
</html>