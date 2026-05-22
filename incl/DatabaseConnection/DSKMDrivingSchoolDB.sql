
-- DATABASE ----------------------------

CREATE DATABASE IF NOT EXISTS DKSM_Driving_School;
USE DKSM_Driving_School;


-- USER LEVEL ----------------------------
CREATE TABLE user_level (
    user_level_id INT AUTO_INCREMENT PRIMARY KEY,
    user_level_name VARCHAR(30) NOT NULL
);

INSERT INTO user_level (user_level_name)
VALUES ('Admin'), ('Instructor'), ('Student');


-- USERS ----------------------------


CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(50),
    user_pwd VARCHAR(50),
    user_full_name VARCHAR(100),
    phone VARCHAR(15),
    email VARCHAR(100),
    user_level_id INT
);

INSERT INTO users (user_name,user_pwd,user_full_name,phone,email,user_level_id)
VALUES
('admin','1234','Mbasa Batyi','0812345678','admin@dksm.co.za',1),
('instructor1','1234','Sipho Dlamini','0823456789','sipho@dksm.co.za',2),
('instructor2','1234','Jane Smith','0834567890','jane@dksm.co.za',2);


-- STUDENTS -------------------------------


CREATE TABLE student (
    student_id INT AUTO_INCREMENT PRIMARY KEY, 
    first_name VARCHAR(50), 
    last_name VARCHAR(50), 
    home_address VARCHAR(50), 
    username VARCHAR(50), 
    password VARCHAR(50), 
    email VARCHAR(100), 
    phone VARCHAR(15), 
    id_number VARCHAR(20), 
    learners_license_file VARCHAR(255), 
    learners_status VARCHAR(30) DEFAULT 'Pending', 
    user_level_id INT DEFAULT 3, 
    date_registered DATETIME DEFAULT CURRENT_TIMESTAMP);

INSERT INTO student (
first_name,
last_name,
username,
home_address,
password,
email,
phone,
id_number,
learners_license_file,
learners_status,user_level_id) 
VALUES 
('Lerato','Nkosi','lerato','234 Kingsway str','1234','lerato@gmail.com','0812345678','0201011234088','uploads/lerato.pdf','Approved',3),
('Siphesihle','Dlamini','sipho','2A Church str','1234','sipho@gmail.com','0823456789','0105055678088','uploads/sipho.pdf','Approved',3),
('Ayanda','Mthembu','ayanda','324 Queens str','1234','ayanda@gmail.com','0811111111','0001015009088','uploads/ayanda.pdf','Approved',3),
('Thando','Zulu','thando','678 Owens str','1234','thando@gmail.com','0822222222','0102026009088','uploads/thando.pdf','Pending',3);



-- SERVICES -------------------------------


CREATE TABLE service (
    service_id INT AUTO_INCREMENT PRIMARY KEY,
    service_name VARCHAR(200),
    service_price DECIMAL(10,2)
);

INSERT INTO service (service_name, service_price)
VALUES
('1 Lesson', 300),
('6 Lessons', 1770),
('6 Lessons + Car', 2720),
('10 Lessons', 2900),
('10 Lessons + Car', 3850),
('20 Lessons', 5700),
('20 Lessons + Car', 6650),
('Custom Package', 0),
('Learners Licence Test Preparation (Per Hour)', 150);


-- BOOKINGS -------------------------------


CREATE TABLE booking_details (
    booking_details_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    service_id INT,
    booking_date DATE,
    booking_time TIME,
    booking_status VARCHAR(30) DEFAULT 'Pending',
    licence_document VARCHAR(255),
    selected_licence_code VARCHAR(100),
    selected_package VARCHAR(100)
);

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
(1,1,'2026-05-20','10:00:00','Confirmed','licence1.pdf','Code 08','300'),
(2,2,'2026-05-21','11:00:00','Confirmed','licence2.pdf','Code 10','300'),
(3,3,'2026-05-22','12:00:00','Completed','licence3.pdf','Code 14','300'),
(4,4,'2026-05-23','13:00:00','Pending','licence4.pdf','Code A','300');
 

-- STUDENT PROGRESS -------------------------------


CREATE TABLE student_progress (
    progress_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    booking_id INT,
    progress_date DATE,
    skill VARCHAR(100),
    comment VARCHAR(255),
    readiness_level VARCHAR(50)
);

INSERT INTO student_progress
(student_id,booking_id,progress_date,skill,comment,readiness_level)
VALUES
(1,1,'2026-05-20','Parking','Good','Intermediate'),
(2,2,'2026-05-21','Turning','Improving','Intermediate'),
(3,3,'2026-05-22','Full Control','Test Ready','Ready'),
(4,4,'2026-05-23','Clutch','Needs practice','Beginner');


-- DRIVER TEST APPLICATION (NO FOREIGN KEYS) -------------------------------
 

CREATE TABLE drivers_test_application (
    application_id INT AUTO_INCREMENT PRIMARY KEY,

    student_id INT,
    booking_id INT,

    application_date DATETIME DEFAULT CURRENT_TIMESTAMP,

    application_status VARCHAR(30) DEFAULT 'Pending',

    form_file VARCHAR(255),
    id_copy_file VARCHAR(255),
    proof_of_address_file VARCHAR(255),
    eye_test_file VARCHAR(255)
);

INSERT INTO drivers_test_application
(student_id,booking_id,
form_file,id_copy_file,proof_of_address_file,eye_test_file,
application_status)

VALUES
(1,1,'form1.pdf','id1.pdf','addr1.pdf','eye1.pdf','Approved'),
(2,2,'form2.pdf','id2.pdf','addr2.pdf','eye2.pdf','Pending'),
(3,3,'form3.pdf','id3.pdf','addr3.pdf','eye3.pdf','Approved'),
(4,4,'form4.pdf','id4.pdf','addr4.pdf','eye4.pdf','Rejected');