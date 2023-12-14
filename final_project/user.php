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

// Create the Users table if it doesn't exist
$create_table_query = "
    CREATE TABLE IF NOT EXISTS Users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL
    )";
if ($connection->query($create_table_query) === TRUE) {
    echo "Table created successfully or already exists.\n";
} else {
    die("Error creating table: " . $connection->error);
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $insert_sql = "INSERT INTO Users (username, password, email) VALUES ('$username', '$password', '$email')";
        $connection->query($insert_sql);
    } elseif (isset($_POST['update'])) {
        $updateId = $_POST['update-id'];
        $newUsername = $_POST['update-username'];
        $newEmail = $_POST['update-email'];

        $update_sql = "UPDATE Users SET username='$newUsername', email='$newEmail' WHERE id='$updateId'";
        $connection->query($update_sql);
    }
}

// Read
$select_sql = "SELECT * FROM Users";
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
    <title>User Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/user.css">
</head>
<body>
<div class="container mt-5">
    <a href="index.html" class="btn btn-primary mb-3">Home</a>
    <h2>User Management</h2>
    <form method="post" action="">
        <h3>Create User</h3>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Create User</button>
    </form>

    <hr>

    <!-- Display Users -->
<h3>Users</h3>
<table class="table">
    <thead>
    <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>
                    <a href='?delete={$row['id']}' class='btn btn-danger'>Delete</a>
                </td>
              </tr>";
    }

    // Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update'])) {
       
        $updateId = $_POST['update-id'];
        $newUsername = $_POST['update-username'];
        $newEmail = $_POST['update-email'];

        $update_sql = "UPDATE Users SET username='$newUsername', email='$newEmail' WHERE id='$updateId'";
        $connection->query($update_sql);
    }
}

    // Delete
if (isset($_GET['delete'])) {
    $deleteId = $_GET['delete'];

    $delete_sql = "DELETE FROM Users WHERE id='$deleteId'";
    $connection->query($delete_sql);
}
    ?>
    </tbody>
</table>

<h3>Update User</h3>
<form method="post" action="">
    <div class="form-group">
        <label for="update-id">User ID:</label>
        <input type="text" name="update-id" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="update-username">New Username:</label>
        <input type="text" name="update-username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="update-email">New Email:</label>
        <input type="email" name="update-email" class="form-control" required>
    </div>
    <button type="submit" name="update" class="btn btn-warning">Update User</button>
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
