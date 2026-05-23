<?php
// DATABASE CONNECTION
include_once "../incl/DatabaseConnection/dbConn.php";

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// UPDATE BOOKING STATUS
if (isset($_POST['booking_details_id']) && isset($_POST['status'])) {

    $booking_details_id = $_POST['booking_details_id'];
    $status             = $_POST['status'];

    $update = "UPDATE booking_details
               SET booking_status = ?
               WHERE booking_details_id = ?";

    $stmt = $conn->prepare($update);
    $stmt->bind_param("si", $status, $booking_details_id);
    $stmt->execute();
}

// GET BOOKINGS
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

$total = $result ? $result->num_rows : 0;

// STATUS COUNTS
$confirmed = 0;
$pending   = 0;
$completed = 0;
$cancelled = 0;

$rows = [];

if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $rows[] = $row;

        if ($row['booking_status'] === 'Confirmed') {
            $confirmed++;
        }

        elseif ($row['booking_status'] === 'Completed') {
            $completed++;
        }

        elseif ($row['booking_status'] === 'Cancelled') {
            $cancelled++;
        }

        else {
            $pending++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Bookings — DSKM Driving School</title>

    <link rel="icon"
          type="image/x-icon"
          href="/DSKMDrivingSchool/incl/images/logo2.png">

    <link rel="stylesheet"
          href="../incl/style/administration/Bookings.css">

</head>

<body>

<div class="shell">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="sidebar-logo">

            <div class="wordmark">
                DSKM<em>Driving School</em>
            </div>

            <div class="sub">
                Administration
            </div>

        </div>

        <ul class="nav">

            <li>
                <a href="/DSKMDrivingSchool/administration/adminDashboard.php">
                    Overview
                </a>
            </li>

            <li>
                <a href="/DSKMDrivingSchool/administration/students.php">
                    Students
                </a>
            </li>

            <li>
                <a href="/DSKMDrivingSchool/administration/Bookings.php"
                   class="active">
                    Bookings
                </a>
            </li>

            <li>
                <a href="/DSKMDrivingSchool/administration/staff.php">
                    Staff
                </a>
            </li>

            <li>
                <a href="/DSKMDrivingSchool/customers/index.html">
                    Logout
                </a>
            </li>

        </ul>

        <div class="sidebar-foot">
            <?php echo date('l, j M Y'); ?>
        </div>

    </aside>

    <!-- MAIN -->
    <div class="main">

        <!-- TOPBAR -->
        <header class="topbar">

            <div>

                <h2>Bookings</h2>

                <p>
                    Manage student bookings and booking statuses
                </p>

            </div>

            <div class="topbar-actions">

                <span class="badge">Live</span>

                <div class="avatar">
                    AD
                </div>

            </div>

        </header>

        <!-- CONTENT -->
        <main class="content">

            <!-- STATS -->
            <div class="section-head">

                <h3>At a Glance</h3>

                <div class="divider-line"></div>

            </div>

            <div class="stat-grid">

                <div class="stat-card">

                    <div class="label">
                        Total Bookings
                    </div>

                    <div class="value">
                        <?php echo $total; ?>
                    </div>

                    <div class="delta">
                        All bookings
                    </div>

                </div>

                <div class="stat-card c-approved">

                    <div class="label">
                        Confirmed
                    </div>

                    <div class="value">
                        <?php echo $confirmed; ?>
                    </div>

                    <div class="delta">
                        Active bookings
                    </div>

                </div>

                <div class="stat-card c-pending">

                    <div class="label">
                        Pending
                    </div>

                    <div class="value">
                        <?php echo $pending; ?>
                    </div>

                    <div class="delta">
                        Awaiting action
                    </div>

                </div>

                <div class="stat-card c-declined">

                    <div class="label">
                        Completed
                    </div>

                    <div class="value">
                        <?php echo $completed; ?>
                    </div>

                    <div class="delta">
                        Finished lessons
                    </div>

                </div>

            </div>

            <!-- TABLE -->
            <div class="section-head">

                <h3>All Bookings</h3>

                <div class="divider-line"></div>

            </div>

            <div class="panel">

                <div class="panel-header">

                    <h4>Booking Records</h4>

                    <input
                        class="search-box"
                        type="text"
                        id="searchInput"
                        placeholder="Search bookings..."
                        oninput="filterTable()"
                    >

                </div>

                <div class="table-wrap">

                    <table id="bookingsTable">

                        <thead>

                            <tr>

                                <th>ID</th>
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

                        <tbody>

                        <?php if (!empty($rows)): ?>

                            <?php foreach ($rows as $row): ?>

                                <?php

                                $statusClass = 'pending';

                                if ($row['booking_status'] === 'Confirmed') {
                                    $statusClass = 'approved';
                                }

                                elseif ($row['booking_status'] === 'Completed') {
                                    $statusClass = 'completed';
                                }

                                elseif ($row['booking_status'] === 'Cancelled') {
                                    $statusClass = 'declined';
                                }

                                ?>

                                <tr>

                                    <td>
                                        <?php echo htmlspecialchars($row['booking_details_id']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['first_name']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['last_name']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['selected_licence_code']); ?>
                                    </td>

                                    <td>
                                        R <?php echo htmlspecialchars($row['selected_package']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['booking_date']); ?>
                                    </td>

                                    <td>
                                        <?php echo htmlspecialchars($row['booking_time']); ?>
                                    </td>

                                    <td>

                                        <a class="file-link"
                                           href="../uploads/<?php echo htmlspecialchars($row['licence_document']); ?>"
                                           target="_blank">

                                            View File

                                        </a>

                                    </td>

                                    <td>

                                        <span class="status <?php echo $statusClass; ?>">

                                            <?php echo htmlspecialchars($row['booking_status']); ?>

                                        </span>

                                    </td>

                                    <td>

                                        <div class="action-buttons">

                                            <!-- CONFIRM -->
                                            <form method="POST">

                                                <input type="hidden"
                                                       name="booking_details_id"
                                                       value="<?php echo $row['booking_details_id']; ?>">

                                                <input type="hidden"
                                                       name="status"
                                                       value="Confirmed">

                                                <button type="submit"
                                                        class="btn btn-approve">

                                                    Confirm

                                                </button>

                                            </form>

                                            <!-- COMPLETE -->
                                            <form method="POST">

                                                <input type="hidden"
                                                       name="booking_details_id"
                                                       value="<?php echo $row['booking_details_id']; ?>">

                                                <input type="hidden"
                                                       name="status"
                                                       value="Completed">

                                                <button type="submit"
                                                        class="btn btn-decline">

                                                    Complete

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else: ?>

                            <tr>

                                <td colspan="10" class="no-records">
                                    No bookings found
                                </td>

                            </tr>

                        <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

</div>

<script src="/DSKMDrivingSchool/incl/js/searchbar.js">

<?php $conn->close(); ?>

</body>
</html>