<?php

/* DB connection include file. Reads credentials from environment variables so the site can run on hosts like Render, Fly, or locally. */

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$DB_HOST = getenv('DB_HOST') ?: 'localhost';
$DB_USER = getenv('DB_USER') ?: 'root';
$DB_PASS = getenv('DB_PASS') ?: '';
$DB_NAME = getenv('DB_NAME') ?: 'DSKM_Driving_School';

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
if ($conn->connect_errno) {
    error_log('DB connect error: ' . $conn->connect_error);
    // Don't expose details to users in production
    die('Database connection error.');
}

