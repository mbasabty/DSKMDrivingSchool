<?php

// DATABASE CONNECTION
include_once "../incl/DatabaseConnection/dbConn.php";

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

/* =========================================================
   TOTAL STUDENTS
========================================================= */
$studentsQuery = "SELECT COUNT(*) AS total_students FROM student";
$studentsResult = $conn->query($studentsQuery);
$studentsData = $studentsResult->fetch_assoc();

$totalStudents = $studentsData['total_students'];

/* =========================================================
   TOTAL BOOKINGS
========================================================= */
$bookingsQuery = "SELECT COUNT(*) AS total_bookings FROM booking_details";
$bookingsResult = $conn->query($bookingsQuery);

$totalBookings = 0;

if ($bookingsResult) {

    $bookingsData = $bookingsResult->fetch_assoc();

    $totalBookings = $bookingsData['total_bookings'];
}

/* =========================================================
   TOTAL INSTRUCTORS
========================================================= */
$instructorsQuery = "SELECT COUNT(*) AS total_instructors
                     FROM users
                     WHERE user_level_id = 2";

$instructorsResult = $conn->query($instructorsQuery);
$instructorsData = $instructorsResult->fetch_assoc();

$totalInstructors = $instructorsData['total_instructors'];

/* =========================================================
   TOTAL ADMINS
========================================================= */
$adminsQuery = "SELECT COUNT(*) AS total_admins
                FROM users
                WHERE user_level_id = 1";

$adminsResult = $conn->query($adminsQuery);
$adminsData = $adminsResult->fetch_assoc();

$totalAdmins = $adminsData['total_admins'];

/* =========================================================
   RECENT STUDENTS
========================================================= */
$recentStudentsQuery = "SELECT
                            first_name,
                            last_name,
                            learners_status,
                            date_registered
                        FROM student
                        ORDER BY date_registered DESC
                        LIMIT 5";

$recentStudentsResult = $conn->query($recentStudentsQuery);

/* =========================================================
   STAFF MEMBERS
========================================================= */
$staffQuery = "SELECT
                    user_full_name,
                    email
                FROM users
                ORDER BY user_full_name ASC
                LIMIT 5";

$staffResult = $conn->query($staffQuery);

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Dashboard</title>

    <link rel="icon"
          type="image/x-icon"
          href="/DSKMDrivingSchool/incl/images/logo2.png">

    <link rel="stylesheet"
          href="../incl/style/administration/adminDashboard.css">

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
                <a href="#"
                   class="active">
                    Overview
                </a>
            </li>

            <li>
                <a href="/DSKMDrivingSchool/administration/students.php">
                    Students
                </a>
            </li>

            <li>
                <a href="/DSKMDrivingSchool/administration/Bookings.php">
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

            <div class="topbar-title">

                <h2>
                    Welcome Back Admin
                </h2>

                <p>
                    Here's what's happening today
                </p>

            </div>

            <div class="topbar-actions">

                <span class="badge">
                    Live
                </span>

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

                <!-- TOTAL STUDENTS -->
                <div class="stat-card">

                    <div class="label">
                        Total Students
                    </div>

                    <div class="value">
                        <?php echo $totalStudents; ?>
                    </div>

                    <div class="delta">
                        Registered students
                    </div>

                </div>

                <!-- BOOKINGS -->
                <div class="stat-card">

                    <div class="label">
                        Total Bookings
                    </div>

                    <div class="value">
                        <?php echo $totalBookings; ?>
                    </div>

                    <div class="delta">
                        All bookings
                    </div>

                </div>

                <!-- INSTRUCTORS -->
                <div class="stat-card">

                    <div class="label">
                        Instructors
                    </div>

                    <div class="value">
                        <?php echo $totalInstructors; ?>
                    </div>

                    <div class="delta">
                        Active instructors
                    </div>

                </div>

                <!-- ADMINS -->
                <div class="stat-card">

                    <div class="label">
                        Admins
                    </div>

                    <div class="value">
                        <?php echo $totalAdmins; ?>
                    </div>

                    <div class="delta">
                        System administrators
                    </div>

                </div>

            </div>

            <!-- DETAILS -->
            <div class="section-head"
                 style="margin-top:1.8rem">

                <h3>Details</h3>

                <div class="divider-line"></div>

            </div>

            <div class="lower-grid">

                <!-- RECENT STUDENTS -->
                <div class="panel">

                    <div class="panel-header">

                        <h4>
                            Recent Students
                        </h4>

                    </div>

                    <?php
                    if ($recentStudentsResult->num_rows > 0) {

                        while ($row = $recentStudentsResult->fetch_assoc()) {

                            echo "
                            <div class='activity-row'>

                                <div>

                                    <strong>
                                        {$row['first_name']} {$row['last_name']}
                                    </strong>

                                    <p>
                                        {$row['learners_status']}
                                    </p>

                                </div>

                                <span>
                                    {$row['date_registered']}
                                </span>

                            </div>
                            ";
                        }

                    } else {

                        echo "
                        <div class='empty'>

                            <em>
                                No students found
                            </em>

                        </div>
                        ";
                    }
                    ?>

                </div>

                <!-- STAFF MEMBERS -->
                <div class="panel">

                    <div class="panel-header">

                        <h4>
                            Staff Members
                        </h4>

                    </div>

                    <?php
                    if ($staffResult->num_rows > 0) {

                        while ($row = $staffResult->fetch_assoc()) {

                            echo "
                            <div class='activity-row'>

                                <div>

                                    <strong>
                                        {$row['user_full_name']}
                                    </strong>

                                    <p>
                                        {$row['email']}
                                    </p>

                                </div>

                            </div>
                            ";
                        }

                    } else {

                        echo "
                        <div class='empty'>

                            <em>
                                No staff found
                            </em>

                        </div>
                        ";
                    }
                    ?>

                </div>

            </div>

        </main>

    </div>

</div>

<?php $conn->close(); ?>

</body>
</html>