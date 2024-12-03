<?php
session_start();
require "mysqldbconn.php";

if (!isset($_SESSION['seller_logged_in']) || $_SESSION['seller_logged_in'] !== true) {
    header('location:seller-login.php'); 
}

$seller_name = $_SESSION['seller_name'];
$seller_email = $_SESSION['seller_email'];

$profile_picture = $_SESSION['profile_picture'] ?? 'img/default-profile.jpg'; 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
    <title>seller Profile</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo"><a href="index.php" style="text-decoration: none; color:white;">
                <p style="font-family: 'Bebas Neue';">Craftique</p>
            </a></div>

        <div class="nav-items">
            <div class="category-list">
                <a href="blog.html" class="category-item">Blog</a>
                <a href="tutorial-vid.html" class="category-item">Tutorial</a>
            </div>
            <input type="text" class="search-bar" placeholder="Search...">

            <a href="watchlist.html" class="nav-link">Watchlist</a>
            <a href="orders.html" class="nav-link">Orders</a>
            <a href="cart.html" class="nav-link">Cart</a>
            <a href="logout.php" class="nav-link">Logout</a>
        </div>
    </nav>
    <section class="profile-section">
        <div class="profile-card">
            <div class="profile-image">
                <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture">
            </div>
            <h1 class="name"><?php echo htmlspecialchars($seller_name); ?></h1>
            <p class="email"><?php echo htmlspecialchars($seller_email); ?></p><br>
            <a href="seller-edit-profile.php" class="edit-profile-btn">Edit Profile</a>
        </div>
    </section>
</body>

</html>
