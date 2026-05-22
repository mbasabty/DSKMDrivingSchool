<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (!empty($_POST['student_id']) && !empty($_POST['status'])) {

        $student_id = $_POST['student_id'];
        $status = $_POST['status'];
        $update = "UPDATE student
                SET learners_status = ?
                WHERE student_id = ?";
        $sqlQuery = $conn->prepare($update);

        if ($sqlQuery) {
            $sqlQuery->bind_param("si", $status, $student_id);
            $sqlQuery->execute();
            $sqlQuery->close();
        } else {
            die("Prepare failed: " . $conn->error);
        }
    }

    $sql = "SELECT
                student_id,
                first_name,
                last_name,
                home_address,
                email,
                phone,
                id_number,
                learners_license_file,
                learners_status,
                date_registered
            FROM student
            ORDER BY date_registered DESC";
    $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Students Table</title>
    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/administration/Students.css">

</head>
<body>
    <div class="students-wrapper">
        <!-- HEADER -->
        <div class="students-header">
            <h2>Students Table</h2>
            <p>
                Manage all registered students and approve
                or decline learner submissions.
            </p>
        </div>

        <!-- TABLE CARD -->
        <div class="students-box">
            <table>
                <!-- TABLE HEADER -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>ID Number</th>
                        <th>Learners File</th>
                        <th>Status</th>
                        <th>Date Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <!-- TABLE BODY -->
                <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // STATUS COLORS
                        $statusClass = "pending";
                        if ($row['learners_status'] == "Approved") {
                            $statusClass = "approved";
                        } elseif ($row['learners_status'] == "Declined") {
                            $statusClass = "declined";
                        }
                        echo "
                        <tr>
                            <td>{$row['student_id']}</td>
                            <td>{$row['first_name']}</td>
                            <td>{$row['last_name']}</td>
                            <td>{$row['home_address']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['phone']}</td>
                            <td>{$row['id_number']}</td>
                            <td>
                                <a class='file-link'
                                href='../uploads/{$row['learners_license_file']}'
                                target='_blank'>
                                View File
                                </a>
                            </td>
                            <td>
                                <span class='status {$statusClass}'>
                                    {$row['learners_status']}
                                </span>
                            </td>
                            <td>{$row['date_registered']}</td>
                            <td>
                                <div class='action-buttons'>
                                    <!-- APPROVE -->
                                    <form method='POST'>
                                        <input type='hidden'
                                            name='student_id'
                                            value='{$row['student_id']}'>

                                        <input type='hidden'
                                            name='status'
                                            value='Approved'>

                                        <button type='submit'
                                                class='btn btn-approve'>
                                                Approve
                                        </button>
                                    </form>

                                    <!-- DECLINE -->
                                    <form method='POST'>
                                        <input type='hidden'
                                            name='student_id'
                                            value='{$row['student_id']}'>

                                        <input type='hidden'
                                            name='status'
                                            value='Declined'>

                                        <button type='submit'
                                                class='btn btn-decline'>

                                                Decline

                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        ";
                    }
                } else {
                    echo "
                    <tr>
                        <td colspan='13' class='no-records'>
                            No students found
                        </td>
                    </tr>
                    ";
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();
?>