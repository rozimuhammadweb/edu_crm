<?php
session_start();
include '../admin/connectDB.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM users WHERE username = ?";
  $stmt = $connect->prepare($sql);
  $stmt->execute([$username]);

  $user = $stmt->fetch(PDO::FETCH_ASSOC);
  if($user && password_verify($password, $user['password'])){
    $_SESSION['username'] = $username;
    header('Location: /admin/course/courses.php');
    exit();
  } else{
    $_SESSION['message'] = "Invalid username or password";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="login.css" />
</head>
<body>
<div class="page">
  <div class="container">
    <div class="left">
      <div class="login">Log In</div>
      <div class="eula">
        By logging in you agree to the ridiculously long terms that you
        didn't bother to read
      </div>
    </div>
    <div class="right">
      <svg viewBox="0 0 320 300">
        <!-- svg content here -->
      </svg>
      <form method="POST" action="login.php" class="form">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required />
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required />
        <input type="submit" value="Submit" />
      </form>
    </div>
  </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.js"></script>
<script src="login.js"></script>
</body>
</html>
