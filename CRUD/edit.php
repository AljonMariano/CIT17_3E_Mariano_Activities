<?php 

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "studentinfo";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


$id = "";
$name = "";
$email = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  
  if (!isset($_GET["id"])){
    header("location: index.php");
    exit;
  }

  $id = $_GET["id"];

  $sql = "SELECT * FROM users WHERE id=$id";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();

  if (!$row) {
      header("location: index.php");
      exit;
  }

  $name = $row["name"];
  $email = $row["email"];
}
else{
  $id = $_POST["id"];
  $name = $_POST["name"];
  $email = $_POST["email"];

  // Debug statement
  var_dump($id, $name, $email);

  do {
    if (empty($id) || empty($name) || empty($email)){
      $errorMessage = "All the fields are required";
      break;
    }

    $sql = "UPDATE users " .
            "SET name ='$name', email='$email' " .
            "WHERE id = $id ";

    $result = $conn->query($sql);

    if (!$result){
      $errorMessage = "Invalid query: ". $conn->error;
      break;
    }

    $successMessage = "Student Record updated correctly";

    header("location: index.php");
    exit;

  } while (false);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Info System</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css
">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js
"></script>
</head>
<body>
  <div class="container my-5">
      <h2>New Record</h2>

      <?php 
      if ( !empty ($errorMessage)){
        echo "
        <div class='alert alert-warning alert-dismissible fade show' role='alert'>
          <string>$errorMessage</string>
          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
        ";
      }
      ?>

<form method="post" action="edit.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Name</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
        </div>
    </div>
    <div class="row mb-3">
        <label class="col-sm-3 col-form-label">Email</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
        </div>
    </div>

    <?php 
    if (!empty($successMessage)) {
        echo "
        <div class='row mb-3'>
            <div class='offset-sm-3 col-sm-6'>
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>$successMessage</strong>
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
            </div>
        </div>";
    }
    ?>

    <div class="row mb-3">
        <div class="offset-sm-3 col-sm-3 d-grid">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </div>
        <div class="col-sm-3 d-grid">
            <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
        </div>
    </div>
</form>

  </div>
  
</body>
</html>