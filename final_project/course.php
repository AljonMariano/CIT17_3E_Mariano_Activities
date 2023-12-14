<?php
// Database connection configuration
$hostname = 'localhost';
$username = 'root';
$password = '';
$database_name = 'mariano';

// Create connection
$connection = new mysqli($hostname, $username, $password);

// Check connection
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Create the database if it doesn't exist
$create_db_query = "CREATE DATABASE IF NOT EXISTS $database_name";
if ($connection->query($create_db_query) === TRUE) {
    echo "Database created successfully or already exists.\n";
} else {
    die("Error creating database: " . $connection->error);
}

// Select the database
$connection->select_db($database_name);

// Create the Course table if it doesn't exist
$create_table_query = "
    CREATE TABLE IF NOT EXISTS Course (
        id INT AUTO_INCREMENT PRIMARY KEY,
        course_name VARCHAR(255) NOT NULL,
        instructor_id VARCHAR(255) NOT NULL
    )";
if ($connection->query($create_table_query) === TRUE) {
    echo "Table created successfully or already exists.\n";
} else {
    die("Error creating table: " . $connection->error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $course_name = $_POST['course_name'];
        $instructor_id = $_POST['instructor_id'];

        $insert_sql = "INSERT INTO Course (course_name, instructor_id) VALUES ('$course_name', '$instructor_id')";
        $connection->query($insert_sql);
    } elseif (isset($_POST['update-course'])) {
        $updateCourseId = $_POST['update-course-id'];
        $newCourseName = $_POST['update-course-name'];
        $newInstructorId = $_POST['update-instructor-id'];

        $update_course_sql = "UPDATE Course SET course_name='$newCourseName', instructor_id='$newInstructorId' WHERE id='$updateCourseId'";
        $connection->query($update_course_sql);
    }
}

// Read
$select_sql = "SELECT * FROM Course";
$result = $connection->query($select_sql);
?>

<!-- The rest of your HTML code goes here -->

<?php
// Close the database connection
$connection->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/course.css">
</head>
<body>

<div class="container mt-5">
<a href="index.html" class="btn btn-primary mb-3">Home</a>
    <h2>Course Management</h2>
    <form method="post" action="">
        <h3>Create Course</h3>
        <div class="form-group">
            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="instructor_id">Instructor ID:</label>
            <input type="text" name="instructor_id" class="form-control" required>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Create Course</button>
    </form>

    <hr>

   <!-- Display Courses -->
<h3>Courses</h3>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Course Name</th>
        <th>Instructor ID</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['course_name']}</td>
                <td>{$row['instructor_id']}</td>
                <td>
                    <a href='course.php?delete-course={$row['id']}' class='btn btn-danger'>Delete</a>
                </td>
              </tr>";
    }
    ?>
    </tbody>
</table>

<h3>Update Course</h3>
<form method="post" action="">
    <div class="form-group">
        <label for="update-course-id">Course ID:</label>
        <input type="text" name="update-course-id" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="update-course-name">New Course Name:</label>
        <input type="text" name="update-course-name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="update-instructor-id">New Instructor ID:</label>
        <input type="text" name="update-instructor-id" class="form-control" required>
    </div>
    <button type="submit" name="update-course" class="btn btn-warning">Update Course</button>
</form>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>

<?php
$connection->close();
?>
