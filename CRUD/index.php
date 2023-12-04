<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Info System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
">
</head>
<body>
  <div class="container my-5">
      <h2>Student Information System</h2>
      <a class="btn btn-primary" href="create.php" role="button">Create Record</a>
      <br>
      <table class="table"
        <thead>
          <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $servername = "localhost";
          $username = "root";
          $password = "";
          $dbname = "studentinfo";

          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);

          // Check connection
          if ($conn->connect_error) {
              die("Connection failed: " . $conn->connect_error);
          }

          // READ all row from database table
          $sql = "SELECT * FROM users";
          $result = $conn->query($sql);

          if (!$result){
            die("Invalid query: " . $conn->error);
          }

          //READ data of each row
          while($row = $result->fetch_assoc()){
            echo "
            <tr>
              <td>$row[id]</td>
              <td>$row[name]</td>
              <td>$row[email]</td>
              <td>
                <a class='btn btn-primary btn-sm' href='/PHPprojects/CRUD/edit.php?id=$row[id]'>Edit</a>
                <a class='btn btn-primary btn-sm' href='/PHPprojects/CRUD/delete.php?id=$row[id]'>Delete</a>
              </td>
        </tr>
          ";
          }
          ?>
            
          
        </tbody>
  </div>
</body>
</html>