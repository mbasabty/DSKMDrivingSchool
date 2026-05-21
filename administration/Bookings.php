<?php
// DATABASE CONNECTION
include_once "../incl/DatabaseConnection/dbConn.php";

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// UPDATE BOOKING STATUS
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $booking_details_id = $_POST['booking_details_id'];
    $status = $_POST['status'];

    $update = "UPDATE booking_details
               SET booking_status = ?
               WHERE booking_details_id = ?";

    $stmt = $conn->prepare($update);
    $stmt->bind_param("si", $status, $booking_details_id);

    $stmt->execute();
}

// FETCH BOOKINGS WITH STUDENT DETAILS
$sql = "SELECT
            booking_details.booking_details_id,
            booking_details.booking_date,
            booking_details.booking_time,
            booking_details.booking_status,
            booking_details.licence_document,
            booking_details.selected_licence_code,
            booking_details.selected_package,

            student.first_name,
            student.last_name

        FROM booking_details

        INNER JOIN student
        ON booking_details.student_id = student.student_id

        ORDER BY booking_details.booking_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Student Bookings</title>

    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/administration/Bookings.css">

</head>

<body>

<div class="students-wrapper">

    <!-- HEADER -->
    <div class="students-header">

        <h2>Student Bookings</h2>

        <p>
            Manage all student bookings and update booking statuses.
        </p>

    </div>

    <!-- TABLE CARD -->
    <div class="students-box">

        <table>

            <!-- TABLE HEADER -->
            <thead>

                <tr>

                    <th>Booking ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Licence Code</th>
                    <th>Package</th>
                    <th>Booking Date</th>
                    <th>Booking Time</th>
                    <th>Licence File</th>
                    <th>Status</th>
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

                    if ($row['booking_status'] == "Confirmed") {
                        $statusClass = "confirmed";
                    }

                    elseif ($row['booking_status'] == "Completed") {
                        $statusClass = "completed";
                    }

                    elseif ($row['booking_status'] == "Cancelled") {
                        $statusClass = "cancelled";
                    }

                    echo "

                    <tr>

                        <td>{$row['booking_details_id']}</td>

                        <td>{$row['first_name']}</td>

                        <td>{$row['last_name']}</td>

                        <td>{$row['selected_licence_code']}</td>

                        <td>R {$row['selected_package']}</td>

                        <td>{$row['booking_date']}</td>

                        <td>{$row['booking_time']}</td>

                        <td>

                            <a class='file-link'
                               href='../uploads/{$row['licence_document']}'
                               target='_blank'>

                               View File

                            </a>

                        </td>

                        <td>

                            <span class='status {$statusClass}'>

                                {$row['booking_status']}

                            </span>

                        </td>

                        <td>

                            <div class='action-buttons'>

                                <!-- CONFIRM -->
                                <form method='POST'>

                                    <input type='hidden'
                                           name='booking_details_id'
                                           value='{$row['booking_details_id']}'>

                                    <input type='hidden'
                                           name='status'
                                           value='Confirmed'>

                                    <button type='submit'
                                            class='btn btn-approve'>

                                            Confirm

                                    </button>

                                </form>

                                <!-- COMPLETE -->
                                <form method='POST'>

                                    <input type='hidden'
                                           name='booking_details_id'
                                           value='{$row['booking_details_id']}'>

                                    <input type='hidden'
                                           name='status'
                                           value='Completed'>

                                    <button type='submit'
                                            class='btn btn-decline'>

                                            Complete

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

                    <td colspan='10' class='no-records'>

                        No bookings found

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
// CLOSE CONNECTION
$conn->close();
?>