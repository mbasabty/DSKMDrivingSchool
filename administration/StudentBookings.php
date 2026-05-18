<?php
    // Database connection
    include_once "../incl/DatabaseConnection/dbConn.php";

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch students
    $sql = "SELECT 
                student_id,
                first_name,
                last_name,
                home_address,
                username,
                password,
                email,
                phone,
                id_number,
                learners_license_file,
                learners_status,
                date_registered
            FROM student";

    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
</head>
<body>

<h2>Students Table</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>Student ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Home Address</th>
        <th>Username</th>
        <th>Password</th>
        <th>Email</th>
        <th>Phone</th>
        <th>ID Number</th>
        <th>Learners License File</th>
        <th>Learners Status</th>
        <th>Date Registered</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['student_id']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['home_address']}</td>
                    <td>{$row['username']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['id_number']}</td>
                    <td>{$row['learners_license_file']}</td>
                    <td>{$row['learners_status']}</td>
                    <td>{$row['date_registered']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='12'>No records found</td></tr>";
    }

    $conn->close();
    ?>

</table>

</body>
</html>