<?php
    session_start();

    // Database connection
     include_once '../incl/DatabaseConnection/dbconn.php';

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get student ID from session
    $student_id = $_SESSION['student_id'];

    // Get selected licence codes
    $codes = [];
    if ($_POST['code_a']  === 'Yes') $codes[] = 'Code A';
    if ($_POST['code_b']  === 'Yes') $codes[] = 'Code B (08)';
    if ($_POST['code_eb'] === 'Yes') $codes[] = 'Code EB';
    if ($_POST['code_c1'] === 'Yes') $codes[] = 'Code C1/C (10)';
    if ($_POST['code_ec'] === 'Yes') $codes[] = 'Code EC (14)';
    $selected_licence_code = implode(', ', $codes);

    // Get package price from form
    $selected_package = $_POST['package'];

    // Look up service_id from service table using the package price
    $price  = mysqli_real_escape_string($conn, $selected_package);
    $result = mysqli_query($conn, "SELECT service_id FROM service WHERE service_price = '$price' LIMIT 1");
    $row    = mysqli_fetch_assoc($result);
    $service_id = $row ? $row['service_id'] : null;

    if (!$service_id) {
        die("Error: No matching service found for the selected package.");
    }

    // Upload licence document
    $upload_dir = "uploads/licences/";
    $file_name  = time() . "_" . basename($_FILES['learners_license']['name']);
    $file_path  = $upload_dir . $file_name;
    move_uploaded_file($_FILES['learners_license']['tmp_name'], $file_path);

    // Booking details
    $booking_date   = date('Y-m-d');
    $booking_time   = date('H:i:s');
    $booking_status = 'Pending';

    // Insert into database
    $sql = "INSERT INTO booking_details 
            (student_id, service_id, booking_date, booking_time, booking_status, licence_document, selected_licence_code, selected_package)
            VALUES ('$student_id', '$service_id', '$booking_date', '$booking_time', '$booking_status', '$file_path', '$selected_licence_code', '$selected_package')";

    if (mysqli_query($conn, $sql)) {
        echo "Booking successful!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
?>