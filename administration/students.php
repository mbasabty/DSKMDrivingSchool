<?php
    // DATABASE CONNECTION
    include_once "../incl/DatabaseConnection/dbConn.php";

    // CHECK CONNECTION
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_POST['student_id']) && isset($_POST['status'])) {
        $student_id = $_POST['student_id'];
        $status     = $_POST['status'];

        $update = "UPDATE student SET learners_status = ? WHERE student_id = ?";
        $stmt   = $conn->prepare($update);
        $stmt->bind_param("si", $status, $student_id);
        $stmt->execute();
    }

    $sql = "SELECT
                student_id, first_name, last_name, home_address,
                email, phone, id_number, learners_license_file,
                learners_status, date_registered
            FROM student
            ORDER BY date_registered DESC";

    $result      = $conn->query($sql);
    $total       = $result ? $result->num_rows : 0;

    // Count statuses
    $approved = $pending = $declined = 0;
    $rows = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
            if ($row['learners_status'] === 'Approved')  $approved++;
            elseif ($row['learners_status'] === 'Declined') $declined++;
            else $pending++;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students — DSKM Driving School</title>
    <link rel="icon" type="image/x-icon" href="/DSKMDrivingSchool/incl/images/logo2.png">
    <link rel = "stylesheet" href="../incl/style/administration/students.css"> 
</head>
<body>
<div class="shell">

    <!-- ── SIDEBAR ── -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="wordmark">DSKM<em>Driving School</em></div>
            <div class="sub">Administration</div>
        </div>

        <ul class="nav">
            <li><a href="/DSKMDrivingSchool/administration/adminDashboard.php">Overview</a></li>
            <li><a href="/DSKMDrivingSchool/administration/students.php" class="active">Students</a></li>
            <li><a href="/DSKMDrivingSchool/administration/Bookings.php">Bookings</a></li>
            <li><a href="/DSKMDrivingSchool/administration/staff.php">Staff</a></li>
            <li><a href="/DSKMDrivingSchool/customers/index.html">Logout</a></li>
        </ul>

        <div class="sidebar-foot"><?php echo date('l, j M Y'); ?></div>
    </aside>

    <!-- ── MAIN ── -->
    <div class="main">

        <!-- ── TOPBAR ── -->
        <header class="topbar">
            <div>
                <h2>Students</h2>
                <p>Manage registrations and approve or decline learner submissions</p>
            </div>
            <div class="topbar-actions">
                <span class="badge">Live</span>
                <div class="avatar" title="Profile">AD</div>
            </div>
        </header>

        <!-- ── CONTENT ── -->
        <main class="content">

            <!-- STAT CARDS -->
            <div class="section-head">
                <h3>At a Glance</h3>
                <div class="divider-line"></div>
            </div>

            <div class="stat-grid">
                <div class="stat-card">
                    <div class="label">Total Students</div>
                    <div class="value"><?php echo $total; ?></div>
                    <div class="delta">All time</div>
                </div>
                <div class="stat-card c-approved">
                    <div class="label">Approved</div>
                    <div class="value"><?php echo $approved; ?></div>
                    <div class="delta">Learners cleared</div>
                </div>
                <div class="stat-card c-pending">
                    <div class="label">Pending</div>
                    <div class="value"><?php echo $pending; ?></div>
                    <div class="delta">Awaiting review</div>
                </div>
                <div class="stat-card c-declined">
                    <div class="label">Declined</div>
                    <div class="value"><?php echo $declined; ?></div>
                    <div class="delta">Not cleared</div>
                </div>
            </div>

            <!-- TABLE -->
            <div class="section-head">
                <h3>All Students</h3>
                <div class="divider-line"></div>
            </div>

            <div class="panel">
                <div class="panel-header">
                    <h4>Student Records</h4>
                    <input
                        class="search-box"
                        type="text"
                        id="searchInput"
                        placeholder="Search students…"
                        oninput="filterTable()"
                    >
                </div>

                <div class="table-wrap">
                    <table id="studentsTable">
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
                        <tbody>
                        <?php if (!empty($rows)): ?>
                            <?php foreach ($rows as $row): ?>
                                <?php
                                    $sc = 'pending';
                                    if ($row['learners_status'] === 'Approved')  $sc = 'approved';
                                    elseif ($row['learners_status'] === 'Declined') $sc = 'declined';
                                ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['home_address']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($row['id_number']); ?></td>
                                    <td>
                                        <a class="file-link"
                                           href="../uploads/<?php echo htmlspecialchars($row['learners_license_file']); ?>"
                                           target="_blank">View File</a>
                                    </td>
                                    <td>
                                        <span class="status <?php echo $sc; ?>">
                                            <?php echo htmlspecialchars($row['learners_status']); ?>
                                        </span>
                                    </td>
                                    <td><?php echo htmlspecialchars($row['date_registered']); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <form method="POST">
                                                <input type="hidden" name="student_id"
                                                       value="<?php echo $row['student_id']; ?>">
                                                <input type="hidden" name="status" value="Approved">
                                                <button type="submit" class="btn btn-approve">Approve</button>
                                            </form>
                                            <form method="POST">
                                                <input type="hidden" name="student_id"
                                                       value="<?php echo $row['student_id']; ?>">
                                                <input type="hidden" name="status" value="Declined">
                                                <button type="submit" class="btn btn-decline">Decline</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="11" class="no-records">No students found</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>
</div>

<script>
    function filterTable() {
        const q = document.getElementById('searchInput').value.toLowerCase();
        document.querySelectorAll('#studentsTable tbody tr').forEach(row => {
            row.style.display = row.textContent.toLowerCase().includes(q) ? '' : 'none';
        });
    }
</script>

<?php $conn->close(); ?>
</body>
</html>