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
    <title>Sign Up</title>
    <link rel="icon" href="gambar/logo-rmbg.png" type="image">
    <link rel="stylesheet" href="css/sign up.css">
</head>
<body>
 <div class="form-container">

 <form action="" method="post">
      <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            }
         }
      ?>
<div class="from">
    
    <div class="container">
    <h1>Register Now</h1>
    <form>
        <label for="username">Email</label>
        <input type="text" id="email" name="email" placeholder="enter your email">
      
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="enter your password">
      
        <label for="confirm password">Re-Enter Password</label>
        <input type="password" id="cppassword" name="cppassword" placeholder="re-enter your password">
      <br><br>
      <button type="submit"><a href="login.php">Sign Up</a></button>
    </form>
  </div>
  <?php
  if($_SERVER['REQUEST_METHOD'] === 'POST'){
    
   $email = $_POST['email'];
   $pass = $_POST['password'];
   $cpass = $_POST['cppassword'];

   $select = "INSERT INTO user_form (email,password) VALUES ('$email','$pass')";

  if (mysqli_query($conn,$select)){
   header("location:login.php");
  }else{
   echo "pendaftaran gagal : ".mysqli_error($conn);
  }


  

}
  ?>
</body>
</html>