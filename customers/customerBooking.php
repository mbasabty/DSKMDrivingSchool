<?php
    include_once '../incl/DatabaseConnection/dbconn.php';

    $student_id = $_COOKIE['student_id'];

    $code = "";

    if ($_POST['code_a'] == "Yes") {
        $code = "Code A";
        }
        elseif ($_POST['code_b'] == "Yes") {
            $code = "Code 08";
            }
            elseif ($_POST['code_eb'] == "Yes") {
                $code = "Code EB";
                }
                elseif ($_POST['code_c1'] == "Yes") {
                    $code = "Code C1/C";
                    }
                    elseif ($_POST['code_ec'] == "Yes") {
                        $code = "Code EC";
                        }

    $package = $_POST['package'];

    $vat_excl = $package / 1.15;
    $vat = $package - $vat_excl;
    $total = $package;

    $booking_date = date("Y-m-d");
    $booking_time = date("H:i:s");

    $service_id = 1;
    $booking_status = "Pending";

    $success = false;

    if ($_POST['confirm_booking'] == 1) {

        $file_name = $_FILES['learners_license']['name'];
        $file_tmp = $_FILES['learners_license']['tmp_name'];

        move_uploaded_file($file_tmp, "../uploads/" . $file_name);

        $sql = "INSERT INTO booking_details
        (
            student_id,
            service_id,
            booking_date,
            booking_time,
            booking_status,
            licence_document,
            selected_licence_code,
            selected_package
        )
        VALUES
        (
            '$student_id',
            '$service_id',
            '$booking_date',
            '$booking_time',
            '$booking_status',
            '$file_name',
            '$code',
            '$package'
        )";

        $success = $conn->query($sql);
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>
    <link rel="icon" type="image/x-icon" href="../incl/images/logo2.png">
    <link rel="stylesheet" href="/DSKMDrivingSchool/incl/style/customers/confirmBooking.css">
</head>

<body>

<div class="container">

    <h1>Booking Summary</h1>

    <div class="summary">

        <p><strong>Licence Code:</strong> <?= $code ?></p>

        <p><strong>Selected Package:</strong> R<?= number_format($package,2) ?></p>

        <p><strong>VAT Exclusive:</strong> R<?= number_format($vat_excl,2) ?></p>

        <p><strong>VAT 15%:</strong> R<?= number_format($vat,2) ?></p>

        <p class="total">Grand Total: R<?= number_format($total,2) ?></p>

    </div>

    <?php if ($success == false) { ?>

        <form method="post" enctype="multipart/form-data">

            <input type="hidden" name="confirm_booking" value="1">
            <input type="hidden" name="package" value="<?= $package ?>">
            <input type="hidden" name="code_a" value="<?= $_POST['code_a'] ?>">
            <input type="hidden" name="code_b" value="<?= $_POST['code_b'] ?>">
            <input type="hidden" name="code_eb" value="<?= $_POST['code_eb'] ?>">
            <input type="hidden" name="code_c1" value="<?= $_POST['code_c1'] ?>">
            <input type="hidden" name="code_ec" value="<?= $_POST['code_ec'] ?>">

            <div style="display:flex; gap:10px; align-items:center;">
                <label>Confirm Learner's License:</label>
                <input type="file" name="learners_license" required>
            </div>

            <button type="submit">Confirm Booking</button>

        </form>

    <?php } ?>

    <?php if ($success == true) { ?>

        <div class="success">
            Successfully Booked!
        </div>

        <form action="/DSKMDrivingSchool/customers/index.html" method="post">
            <button type="submit">Logout</button>
        </form>

    <?php } ?>

</div>

</body>
</html>