<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // COUNTS 
    $totalStudents = $conn->query("SELECT COUNT(*) AS c 
                                   FROM student")->fetch_assoc()['c'];

    $totalBookings = $conn->query("SELECT COUNT(*) AS c 
                                   FROM booking_details")->fetch_assoc()['c'];

    $totalInstructors = $conn->query("SELECT COUNT(*) AS c 
                                      FROM users 
                                      WHERE user_level_id = 2")->fetch_assoc()['c'];

    $totalAdmins = $conn->query("SELECT COUNT(*) AS c 
                                 FROM users 
                                 WHERE user_level_id = 1")->fetch_assoc()['c'];

    // LISTS
    $recentStudents = $conn->query("
        SELECT first_name, last_name, learners_status, date_registered
        FROM student
        ORDER BY date_registered DESC
    ");

    $staff = $conn->query("
        SELECT user_full_name, email
        FROM users
        ORDER BY user_full_name ASC
    ");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/DSKMDrivingSchool/incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/administration/adminDashboard.css">
</head>

<body>

<div class="shell">
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="wordmark">
                DSKM<em>Driving School</em>
            </div>
            <div class="sub">Administration</div>
        </div>

        <ul class="nav">
            <li><a href="#" class="active">Overview</a></li>
            <li><a href="/DSKMDrivingSchool/administration/students.php">Students</a></li>
            <li><a href="/DSKMDrivingSchool/administration/Bookings.php">Bookings</a></li>
            <li><a href="/DSKMDrivingSchool/administration/staff.php">Staff</a></li>
            <li><a href="/DSKMDrivingSchool/customers/index.html">Logout</a></li>
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
                <h2>Welcome Back Admin</h2>
                <p>Here's what's happening today</p>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="content">

            <!-- STATS -->
            <div class="stat-grid">

                <div class="stat-card">
                    <div>Total Students</div>
                    <div class="value"><?php echo $totalStudents; ?></div>
                </div>

                <div class="stat-card">
                    <div>Total Bookings</div>
                    <div class="value"><?php echo $totalBookings; ?></div>
                </div>

                <div class="stat-card">
                    <div>Instructors</div>
                    <div class="value"><?php echo $totalInstructors; ?></div>
                </div>

                <div class="stat-card">
                    <div>Admins</div>
                    <div class="value"><?php echo $totalAdmins; ?></div>
                </div>

            </div>

            <!-- DETAILS -->
            <div class="lower-grid">

                <!-- RECENT STUDENTS -->
                <div class="panel">
                    <h4>Recent Students</h4>

                    <?php if ($recentStudents->num_rows > 0): ?>
                        <?php while ($row = $recentStudents->fetch_assoc()): ?>
                            <div class="activity-row">
                                <div>
                                    <strong>
                                        <?php echo $row['first_name'] . " " . $row['last_name']; ?>
                                    </strong>
                                    <p><?php echo $row['learners_status']; ?></p>
                                </div>
                                <span><?php echo $row['date_registered']; ?></span>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No students found</p>
                    <?php endif; ?>

                </div>

                <!-- STAFF -->
                <div class="panel">
                    <h4>Staff Members</h4>

                    <?php if ($staff->num_rows > 0): ?>
                        <?php while ($row = $staff->fetch_assoc()): ?>
                            <div class="activity-row">
                                <div>
                                    <strong><?php echo $row['user_full_name']; ?></strong>
                                    <p><?php echo $row['email']; ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No staff found</p>
                    <?php endif; ?>

                </div>

            </div>

        </main>
    </div>
</div>

<?php $conn->close(); ?>

</body>
</html>