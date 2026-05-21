<?php

include_once '../incl/DatabaseConnection/dbconn.php';

$student_id = $_COOKIE['student_id'];

$sqlStudent = $conn->prepare("
SELECT first_name,
       last_name,
       username,
       email
FROM student
WHERE student_id = ?
");

$sqlStudent->bind_param("i", $student_id);
$sqlStudent->execute();

$resultStudent = $sqlStudent->get_result();
$student = $resultStudent->fetch_assoc();

$full_name = $student['first_name'] . " " . $student['last_name'];

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

$licence_document = $_FILES['learners_license']['name'];

$target_folder = "../uploads/";

move_uploaded_file(
    $_FILES['learners_license']['tmp_name'],
    $target_folder . $licence_document
);

if ($_POST['confirm_booking'] == 1) {

    $sqlQuery = "
    INSERT INTO booking_details
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
    (?,?,?,?,?,?,?,?)
    ";

    $service_id = 1;
    $booking_status = "Pending";

    $sql = $conn->prepare($sqlQuery);

    $sql->bind_param(
        "iissssss",
        $student_id,
        $service_id,
        $booking_date,
        $booking_time,
        $booking_status,
        $licence_document,
        $code,
        $package
    );

    if($sql->execute()){

        header("Location: customerMenu.php");
        exit();

    } else {

        echo $sql->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Booking</title>

    <style>

        body{
            font-family: Arial;
            background:#f4f4f4;
        }

        .container{
            width:500px;
            margin:40px auto;
            background:white;
            padding:30px;
            border-radius:10px;
        }

        h1{
            text-align:center;
        }

        .summary{
            margin-top:20px;
        }

        .summary p{
            padding:10px 0;
            border-bottom:1px solid #ddd;
        }

        .total{
            font-size:20px;
            font-weight:bold;
            color:green;
        }

        button{
            width:100%;
            padding:15px;
            background:#007bff;
            border:none;
            color:white;
            font-size:16px;
            border-radius:5px;
            cursor:pointer;
            margin-top:20px;
        }

    </style>

</head>

<body>

<div class="container">

    <h1>Booking Summary</h1>

    <div class="summary">

        <p>
            <strong>Licence Code:</strong>
            <?= $code ?>
        </p>

        <p>
            <strong>Selected Package:</strong>
            R<?= number_format($package,2) ?>
        </p>

        <p>
            <strong>VAT Exclusive:</strong>
            R<?= number_format($vat_excl,2) ?>
        </p>

        <p>
            <strong>VAT 15%:</strong>
            R<?= number_format($vat,2) ?>
        </p>

        <p class="total">
            Grand Total:
            R<?= number_format($total,2) ?>
        </p>

    </div>

    <form method="post" enctype="multipart/form-data">

        <input type="hidden" name="confirm_booking" value="1">

        <input type="hidden" name="package" value="<?= $package ?>">

        <input type="hidden" name="code_a" value="<?= $_POST['code_a'] ?>">
        <input type="hidden" name="code_b" value="<?= $_POST['code_b'] ?>">
        <input type="hidden" name="code_eb" value="<?= $_POST['code_eb'] ?>">
        <input type="hidden" name="code_c1" value="<?= $_POST['code_c1'] ?>">
        <input type="hidden" name="code_ec" value="<?= $_POST['code_ec'] ?>">

        <input type="hidden" name="learners_license" value="<?= $licence_document ?>">

        <button type="submit">
            Confirm Booking
        </button>

    </form>

</div>

</body>
</html>