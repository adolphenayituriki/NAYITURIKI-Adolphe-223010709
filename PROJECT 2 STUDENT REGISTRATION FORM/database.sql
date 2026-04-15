CREATE DATABASE IF NOT EXISTS student_registration;

USE student_registration;

CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50),
    date_of_birth DATE NOT NULL,
    email_id VARCHAR(100) NOT NULL,
    mobile_number VARCHAR(20),
    gender VARCHAR(10),
    address TEXT,
    city VARCHAR(50),
    pin_code VARCHAR(20),
    state VARCHAR(50),
    country VARCHAR(50) NOT NULL,
    hobbies VARCHAR(255),
    board1 VARCHAR(50),
    percentage1 VARCHAR(10),
    year_of_passing1 VARCHAR(10),
    board2 VARCHAR(50),
    percentage2 VARCHAR(10),
    year_of_passing2 VARCHAR(10),
    board3 VARCHAR(50),
    percentage3 VARCHAR(10),
    year_of_passing3 VARCHAR(10),
    board4 VARCHAR(50),
    percentage4 VARCHAR(10),
    year_of_passing4 VARCHAR(10),
    courses_applied_for VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);