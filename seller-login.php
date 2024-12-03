<?php
session_start();
require "mysqldbconn.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $sql = "SELECT * FROM seller WHERE email = '$email' AND password = '$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['seller_logged_in'] = true; // Set login session
        $_SESSION['seller_name'] = $row['name']; // Save seller name for later use
        echo '<script>alert("Successfully Logged in!");</script>';
        header('location:seller.php');
    } else {
        $error[] = '
        <script>
        alert("Incorrect password or email!");
        </script>
        ';
    }
}
$_SESSION['seller_email'] = $row['email'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/styles-login.css">
    <link rel="stylesheet" type="text/css" href="css/styles.css">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
    <title>Seler-Login</title>
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
            <h2>Seller Login</h2>
            <form class="login-form" method="POST" action="">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" name="submit">Login</button>
            </form>
            <div class="additional-links">
                <a href="seller-register.php" class="register-link">Create an Seller account</a>
            </div>
        </div>
    </div>
</body>

</html>