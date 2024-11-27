<?php
session_start();
require "mysqldbconn.php";

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pass = md5($_POST['password']);
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $_SESSION['user_logged_in'] = true; // Set login session
        $_SESSION['user_name'] = $row['name']; // Save user name for later use
        header('location:index.php');
    } else {
        $error[] = '
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Incorrect password or email
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        ';
    }
}

$_SESSION['user_email'] = $row['email'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link rel="stylesheet" type="text/css" href="css/styles-login.css">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
    <title>User-Login</title>
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
            if (isset($error)) {
                foreach ($error as $err) {
                    echo $err;
                }
            }
        ?>
        </div>
        <div class="login-box">
            <h2>User Login</h2>
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
                <a href="user-register.php" class="register-link">Create an account</a>
                <a href="seller-login.php" class="admin-link">Seller Login</a>
            </div>
        </div>
    </div>
</body>

</html>
