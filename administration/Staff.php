<?php
    include_once "../incl/DatabaseConnection/dbConn.php";

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT
                users.user_id,
                users.user_full_name,
                users.phone,
                users.email,
                user_level.user_level_name
            FROM users
            INNER JOIN user_level
            ON users.user_level_id = user_level.user_level_id
            ORDER BY users.user_full_name ASC";

    $result = $conn->query($sql);
    $total = $result ? $result->num_rows : 0;
    $rows = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff — DSKM Driving School</title>
    <link rel="icon" type="image/x-icon" href="/DSKMDrivingSchool/incl/images/logo2.png">
    <link rel="stylesheet" href="../incl/style/administration/staff.css">
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
                    <a href="/DSKMDrivingSchool/administration/Bookings.php">
                        Bookings
                    </a>
                </li>

                <li>
                    <a href="/DSKMDrivingSchool/administration/staff.php"
                    class="active">
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
                    <h2>Staff</h2>
                    <p>
                        View and manage all registered staff members
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
                    <div class="stat-card">
                        <div class="label">
                            Total Staff
                        </div>
                        <div class="value">
                            <?php echo $total; ?>
                        </div>
                        <div class="delta">
                            Registered employees
                        </div>
                    </div>
                </div>

                <!-- TABLE -->
                <div class="section-head">
                    <h3>All Staff</h3>
                    <div class="divider-line"></div>
                </div>

                <div class="panel">
                    <div class="panel-header">
                        <h4>Staff Records</h4>
                        <input
                            class="search-box"
                            type="text"
                            id="searchInput"
                            placeholder="Search staff..."
                            oninput="filterTable()"
                        >
                    </div>

                    <div class="table-wrap">
                        <table id="staffTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Position</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php if (!empty($rows)): ?>
                                <?php foreach ($rows as $row): ?>
                                    <tr>
                                        <td>
                                            <?php echo htmlspecialchars($row['user_id']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($row['user_full_name']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($row['phone']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($row['email']); ?>
                                        </td>
                                        <td>
                                            <?php echo htmlspecialchars($row['user_level_name']); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5"
                                        class="no-records">
                                        No staff records found
                                    </td>
                                </tr>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- ACTION BUTTONS -->
                <div class="outside-box">
                    <a class="staff-btn"
                    href="/DSKMDrivingSchool/administration/addStaff.php">
                        ADD STAFF
                    </a>

                    <a class="staff-btn"
                    href="/DSKMDrivingSchool/administration/deleteStaff.php">
                        DELETE STAFF
                    </a>

                    <a class="staff-btn"
                    href="/DSKMDrivingSchool/administration/updateStaff.php">

                        UPDATE STAFF

                    </a>
                </div>
            </main>
        </div>
    </div>

    <script src="../incl/Js/searchbar.js"></script>
    
    <?php $conn->close(); ?>
    </body>
</html>