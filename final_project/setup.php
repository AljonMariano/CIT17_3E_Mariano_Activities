<?php
// Replace 'your_last_name' with your actual last name
$database_name = 'mariano';

// Create a connection to the MySQL server
$connection = new mysqli('localhost', 'root', '', '');

// Check the connection
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Create the database
$create_database_sql = "CREATE DATABASE IF NOT EXISTS $database_name";
if ($connection->query($create_database_sql) === FALSE) {
    die('Error creating database: ' . $connection->error);
}

// Select the database
$connection->select_db($database_name);

// Create Users table
$create_users_table_sql = "
CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)";
if ($connection->query($create_users_table_sql) === FALSE) {
    die('Error creating Users table: ' . $connection->error);
}

// Create Student table
$create_student_table_sql = "
CREATE TABLE IF NOT EXISTS Student (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    address VARCHAR(255) NOT NULL
)";
if ($connection->query($create_student_table_sql) === FALSE) {
    die('Error creating Student table: ' . $connection->error);
}

// Create Course table
$create_course_table_sql = "
CREATE TABLE IF NOT EXISTS Course (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL,
    instructor_id INT NOT NULL
)";
if ($connection->query($create_course_table_sql) === FALSE) {
    die('Error creating Course table: ' . $connection->error);
}

// Create Instructor table
$create_instructor_table_sql = "
CREATE TABLE IF NOT EXISTS Instructor (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255) NOT NULL,
    last_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
)";
if ($connection->query($create_instructor_table_sql) === FALSE) {
    die('Error creating Instructor table: ' . $connection->error);
}

// Create Enrollment table
$create_enrollment_table_sql = "
CREATE TABLE IF NOT EXISTS Enrollment (
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    PRIMARY KEY (student_id, course_id)
)";
if ($connection->query($create_enrollment_table_sql) === FALSE) {
    die('Error creating Enrollment table: ' . $connection->error);
}

echo 'Database and tables created successfully';

// Close the connection
$connection->close();
?>
