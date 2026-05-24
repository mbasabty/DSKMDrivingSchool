<?php

/* DB connection include file. */

mysqli_report(MYSQLI_REPORT_ERROR);
    $conn = new mysqli(
            //server_name, user_name, password, db_name
            "localhost", "Mbasa Batyi", "4540469","DKSM_Driving_School"
            );

    //echo $conn->host_info . "\n";