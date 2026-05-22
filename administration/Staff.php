<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details</title>
    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/administration/staff.css">
</head>

<body>

    <div class="staff-wrapper">

        <!-- HEADER -->
        <div class="staff-header">
            <h2>Staff Table</h2>
            <p>View all registered staff members</p>
        </div>

        <!-- TABLE CARD -->
        <div class="staff-box">

            <table>
                <thead>
                    <tr>
                        <th>Staff Full Name</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Position</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "
                                <tr>
                                    <td>{$row['user_full_name']}</td>
                                    <td>{$row['phone']}</td>
                                    <td>{$row['email']}</td>
                                    <td>{$row['user_level_name']}</td>
                                </tr>
                            ";
                        }
                    } else {
                        echo "
                            <tr>
                                <td colspan='4' class='no-records'>
                                    No records found
                                </td>
                            </tr>
                        ";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>