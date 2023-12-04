<?php
session_start();

if (isset($_POST['logout'])) {
 
  session_unset();
  session_destroy();

  header('Location: signup.php');
  exit;
}

if (isset($_POST['submit'])) {
  $username = isset($_POST['username']) ? $_POST['username'] : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  if ($username === 'admin' && $password === 'admin') {
    $_SESSION['username'] = $username;
    header('Location: success.php');
    exit;
  } else {
    header('Location: wrong.php');
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>

  <h1 align="center" style="font-size: 50px">Login</h1>

  

  <form align="center" action="signup.php" method="post">
    <input align="center" type="text" name="username" placeholder="Username">
    <input align="center" type="password" name="password" placeholder="Password">
    <input align="center" type="submit" name="submit" value="Login">
  </form>

  <?php if (isset($error) && !empty($error)) : ?>
    <p align="center" style="color: red;"><?php echo $error; ?></p>
  <?php endif; ?>

</body>
</html>
