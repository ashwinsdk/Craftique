<?php
session_start();
require "mysqldbconn.php";

if(isset($_POST['submit'])){

  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = md5($_POST['password']);
  $cpass= md5($_POST['cpassword']);

   $select = " SELECT * FROM seller WHERE email = '$email' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){
    $error[] = '
        <script>
        alert("seller already exists!");
        </script>
    ';

   }else{

      if($pass != $cpass){
        $error[] = '
        <script>
        alert("Passwords do not match!");
        </script>
    ';
      }else{
        $insert = "INSERT INTO seller (name, email, password, profile_picture) VALUES ('$name', '$email', '$pass', 'img/default-profile.jpg')";

        $query = mysqli_query($conn, $insert);
        if ($query) {
            header('location:seller-login.php'); // Redirect to login page
        } else {
            echo '<script>alert("Registration failed!");</script>';
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
    <title>seller-Register</title>
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <a href="index.php" style="text-decoration: none; color:white;">
                <h1 style="font-family: 'Bebas Neue';">Craftique</h1>
            </a>
        </div>
        <div class="login-box">
        <div>
        <?php
                  if(isset($error)){
                    foreach($error as $error){
                       echo $error;
                    }
                    }
                  ?>
        </div>
            <h2>Seller Register</h2>
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
                    <input type="password" id="cpassword" name="cpassword" required>
                </div>
                <button type="submit" name="submit">Create</button>
            </form>
            <div class="additional-links">
                <a href="seller-login.php" class="register-link">Already have an seller account?</a>
            </div>
        </div>
    </div>
</body>

</html>