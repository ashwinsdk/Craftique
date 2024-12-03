<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <nav class="navbar">
        <div class="logo"><a href="index.html" style="text-decoration: none;color:white;">
                <p style="font-family: 'Bebas Neue';">Craftique</p>
            </a></div>
        <div class="nav-items">
            <?php if (isset($_SESSION['seller_logged_in']) && $_SESSION['seller_logged_in'] === true): ?>
                <a href="seller-profile.php" class="nav-link">Profile</a>
            <?php else: ?>
                <a href="seller-register.php" class="nav-link">Sign In</a>
            <?php endif; ?>
        </div>
    </nav>
    <section class="admin-dashboard">
        <h2>Seller Dashboard</h2>
        <div class="admin-section">
            <h3>Total Orders</h3>
            <p>Total orders today: <strong>125</strong></p>
        </div>
        <div class="admin-section">
            <h3>Track Products</h3>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Product 1</td>
                        <td>100</td>
                        <td>₹29.99</td>
                        <td>Available</td>
                        <td><button type="submit" class="view-button">View Product</button></td>
                    </tr>
                    <tr>
                        <td>Product 2</td>
                        <td>50</td>
                        <td>₹19.99</td>
                        <td>Low Stock</td>
                        <td><button type="submit" class="view-button">View Product</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>

</html>