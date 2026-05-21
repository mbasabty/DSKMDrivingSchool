<!DOCTYPE html>
<!-- Login page for the remedies DB app -->
<html>
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel = "stylesheet" href="../incl/style/administration/adminDashboard.css"> <!-- ../incl/css/SalesDashboard.css-->
    <link rel = "icon" type="image/png" href="../../incl/images/logo.png">
</head>

<body>

<div class="login-container">

<h2>Sales Dashboard</h2>

<?php
/*
// ============================================================
//  REQUIRES
// ============================================================
// require_once 'incl/dbconn.php';

// ============================================================
//  QUERY HELPERS — swap in your real SQL queries here
// ============================================================

function getStats(PDO $pdo): array {

    return [
        'total_users' => 0,
        'revenue'     => 0.00,
        'orders'      => 0,
        'growth'      => 0.0,
    ];
}

function getRecentActivity(PDO $pdo): array {
    return [];
}

function getTopItems(PDO $pdo): array {
    return [];
}

// ============================================================
//  FETCH DATA
// ============================================================
$db_error = null;
$stats    = ['total_users' => '—', 'revenue' => '—', 'orders' => '—', 'growth' => '—'];
$activity = [];
$top      = [];

try {
    $pdo      = getDBConnection();
    $raw      = getStats($pdo);
    $stats    = [
        'total_users' => number_format((int)   $raw['total_users']),
        'revenue'     => '$' . number_format((float) $raw['revenue'], 2),
        'orders'      => number_format((int)   $raw['orders']),
        'growth'      => number_format((float) $raw['growth'], 1) . '%',
    ];
    $activity = getRecentActivity($pdo);
    $top      = getTopItems($pdo);
} catch (Exception $e) {
    $db_error = htmlspecialchars($e->getMessage());
}

// ============================================================
//  TIME GREETING
// ============================================================
$hour     = (int) date('G');
$greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css">
</head>
<body>
    <?php include 'incl/dbconn.php';
    ?>
<div class="shell">

  <!-- Sidebar -->
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
      <li><a href="#">Sales</a></li>
      <li><a href="/DSKMDrivingSchool/customers/index.html">Logout</a></li>
    </ul>

    <div class="sidebar-foot">
      <?php echo date('l, j M Y'); ?>
    </div>
  </aside>

  <!-- Main -->
  <div class="main">

    <!-- Topbar -->
    <header class="topbar">
      <div class="topbar-title">
        <h2>Welcom Back Admin</h2>
        <p>Here's what's happening today</p>
      </div>

      <div class="topbar-actions">
        <span class="badge">Live</span>
        <div class="avatar" title="Profile">AD</div>
      </div>
    </header>

    <!-- Content -->
    <main class="content">

      <?php /* if ($db_error): */ ?>
      <!--
        <div class="error-banner">
          <strong>Database error:</strong> <?php /* echo $db_error; */ ?>
        </div>
      -->
      <?php /* endif; */ ?>

      <!-- Stat cards -->
      <div class="section-head">
        <h3>At a Glance</h3>
        <div class="divider-line"></div>
      </div>

      <div class="stat-grid">
        <div class="stat-card">
          <div class="label">Total Students</div>
          <div class="value"><?php /* echo $stats['total_users']; */ ?>0</div>
          <div class="delta">All time</div>
        </div>

        <div class="stat-card">
          <div class="label">Monthly Revenue</div>
          <div class="value"><?php /* echo $stats['revenue']; */ ?>R0.00</div>
          <div class="delta">This month</div>
        </div>

        <div class="stat-card">
          <div class="label">Bookings</div>
          <div class="value"><?php /* echo $stats['orders']; */ ?>0</div>
          <div class="delta">Since midnight</div>
        </div>

        <div class="stat-card">
          <div class="label">Available Instructors</div>
          <div class="value"><?php /* echo $stats['growth']; */ ?>0</div>
          <div class="delta">vs last period</div>
        </div>
      </div>

      <!-- Details -->
      <div class="section-head" style="margin-top:1.8rem">
        <h3>Details</h3>
        <div class="divider-line"></div>
      </div>

      <div class="lower-grid">

        <!-- Recent Activity -->
        <div class="panel">
          <div class="panel-header">
            <h4>Recent Activity</h4>
            <a href="#" class="see-all">See all</a>
          </div>

          <div class="empty">
            <em>No activity yet</em>
          </div>

          <?php /*
          if (!empty($activity)) {
              foreach ($activity as $row) {
          */ ?>
                <!-- activity row -->
          <?php /*
              }
          }
          */ ?>
        </div>

        <!-- Top Items -->
        <div class="panel">
          <div class="panel-header">
            <h4>Top Items</h4>
            <a href="#" class="see-all">See all</a>
          </div>

          <div class="empty">
            <em>No data yet</em>
          </div>

          <?php /*
          if (!empty($top)) {
              foreach ($top as $item) {
          */ ?>
                <!-- item row -->
          <?php /*
              }
          }
          */ ?>
        </div>

      </div>

    </main>
  </div>
</div>

</body>
</html>

</div>

</body>
</html>