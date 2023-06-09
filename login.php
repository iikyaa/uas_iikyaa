<?php

require_once('koneksi.php');

session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="gambar/logo-rmbg.png" type="image">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="from">
    
    <div class="container">
    <h1>Login</h1>
    <form method="POST">
        <label for="email">Email</label>
        <input type="text" id="email" name="email" placeholder="enter your email">
      
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="enter your password">
     <br><br>
         <input type="submit" value="LOGIN">
      <p>don't have an account?<a href="sign up.php">Register now</a></p>
    </form>
  </div>
  <?php
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   // Ambil nilai dari form login
   $email = $_POST['email'];
   $password = $_POST['password'];

   // Cek email dan password di database
   $query = "SELECT * FROM user_form WHERE email = '$email' AND password = '$password'";
   $result = $conn->query($query);
   if ($result->num_rows > 0) {
     // Login berhasil, redirect ke halaman home.php
     $_SESSION['email'] = $email; // Set session email
     header("Location: home.php");
     exit();
   } else {
     // email atau password salah, tampilkan notifikasi
     $errorMessage = "email atau password salah!";
   }
 }
 ?>
</body>
</html>