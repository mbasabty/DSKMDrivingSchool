# DSKMDrivingSchool Website Setup
## Overview
IFS242 is a group assignment that contributes approximately 40% of our final semester mark. 
The project involves designing and programming a functional server-side website that offers a service to customers. 
The website is accessible to both customers and administrators.

---

## Requirements
Before running the project, make sure you have the following installed:

- MAMP
- A web browser

---

## Setup Instructions

### 1. Start Your Server
Open MAMP and ensure that both Apache and MySQL servers are running.

---

### 2. Download the Project Folder
Download the project folder:

DSKMDrivingSchool

---

### 3. Move the Project to MAMP
Place the project folder inside the htdocs directory:

MAMP/htdocs/DSKMDrivingSchool

---

### 4. Database Configuration
Firstly, locate the .sql file of the database under the folder "groupDetails" 
and import onto your myPHPAdmin. 

Secondly, open the database connection file:
incl/DatabaseConnection/

Update credentials:

<?php
    mysqli_report(MYSQLI_REPORT_ERROR);
    $conn = new mysqli(
        "localhost","your_username","your_password","DKSM_Driving_School"
    );
?>

IMPORTANT: Replace username and password with your own MAMP/MySQL credentials.

---

### 5. Import Database
Make sure the database DKSM_Driving_School is imported into phpMyAdmin by refreshing after
importing the .sql fie

"DSKMDrivingSchoolDB.sql"

---

### 6. Open the Website
Open your browser and go to:

http://localhost/DSKMDrivingSchool/Customers/

## Access Levels

Customers:
- View driving school information
- Browse services
- Book a service

Administrator:
- Manage staff and bookings
- Access admin dashboard
- Login via same login page as customers

    To access the admin dashboard use:
    username: admin
    password: GH00

---

## Troubleshooting

- Ensure MAMP is running
- Check folder is in htdocs
- Confirm database is imported
- Verify credentials are correct
- Check URL port number
- Ensure folder name is exactly DSKMDrivingSchool
