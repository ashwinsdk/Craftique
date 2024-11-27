<?php
session_start();
require "mysqldbconn.php";

if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = md5($_POST['password']);
  $cpass= md5($_POST['cpassword']);

   $select = " SELECT * FROM users WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
    $error[] = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                user already exist!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
    ';

   }else{

      if($pass != $cpass){
        $error[] = '
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                password not matched!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
    ';
      }else{
         $insert = "INSERT INTO users(name,email,password) 
         VALUES('$name','$email','$pass')";
         $query=mysqli_query($conn, $insert);
         if($query == true){
          header('location:user-login.php');
        }else{
          echo 'failed';
        }
      }
   }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/styles-login.css">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
    <title>User-Register</title>
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <a href="index.php" style="text-decoration: none; color:white;">
                <h1 style="font-family: 'Bebas Neue';">Craftique</h1>
            </a>
        </div>
        <div>
        <?php
                  if(isset($error)){
                    foreach($error as $error){
                       echo $error;
                    }
                    }
                  ?>
        </div>
        <div class="login-box">
            <h2>User Register</h2>
            <form class="login-form" method="POST" action="">
                <div class="input-group">
                    <label for="email">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="input-group">
                    <label for="password">Confirm Password</label>
                    <input type="password" id="ccpassword" name="cpassword" required>
                </div>
                <button type="submit" name="submit">Create</button>
            </form>
            <div class="additional-links">
                <a href="user-login.php" class="register-link">Already have an account?</a>
            </div>
        </div>
    </div>
</body>

</html>