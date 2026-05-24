# DSKMDrivingSchool Website Setup

## Overview
IFS242 is a group assignment that contributes approximately 40% of our final semester mark. The project involves designing and programming a functional server-side website that sells products or offers services to customers. The website is accessible to both customers and administrators.

---

## Requirements
Before running the project, make sure you have the following installed:

- MAMP
- A web browser

---

## Setup Instructions

### 1. Start Your Server
Open MAMP and make sure the Apache and MySQL servers are running.

---

### 2. Download the Project Folder
Download the main project folder named:

```bash
DSKMDrivingSchool
```

---

### 3. Move the Folder to MAMP
Place the `DSKMDrivingSchool` folder inside the `htdocs` directory in your MAMP folder located on your local drive.

Example path:

```bash
MAMP/htdocs/DSKMDrivingSchool
```

---

### 4. Database Configuration
Open the database connection file and update the MySQL username and password to match your local MAMP/MySQL setup.

Example:

```php
<?php

/* DB connection include file. */

mysqli_report(MYSQLI_REPORT_ERROR);

$conn = new mysqli(
    // server_name, user_name, password, db_name
    "localhost",
    "your_username",
    "your_password",
    "DKSM_Driving_School"
);

// echo $conn->host_info . "\n";
```

> **Important:**  
> Replace `your_username` and `your_password` with your own MySQL/MAMP credentials before running the project.

---

### 5. Open the Website
Go to your browser and enter the following URL to load the website:

```bash
http://localhost:8888/DSKMDrivingSchool/Customers/
```

---

## Note About Port Numbers
The port number in the URL may differ depending on your MAMP configuration.

Example:

```bash
http://localhost:8888/DSKMDrivingSchool/Customers/
```

- `8888` is the default Apache port commonly used by MAMP.
- Some users may use a different port such as `80`.
- Check your MAMP port settings if the website does not load correctly.

---

## Access
- **Customers:** Can browse and use the website services.
- **Administrators:** Can manage the website through the admin functionality. They log in using the same login page as customers and will be redirected to their respective dashboard after successful login.

---
## Troubleshooting
- Ensure MAMP servers are running.
- Verify the project folder is inside the `htdocs` directory.
- Confirm that the database credentials are correct.
- Check that the database `DKSM_Driving_School` has been imported successfully.
- Verify the correct port number is being used in the browser URL.
