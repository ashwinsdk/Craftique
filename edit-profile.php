<?php
session_start();
require "mysqldbconn.php";

// Check if the user is logged in
if (!isset($_SESSION['user_logged_in']) || $_SESSION['user_logged_in'] !== true) {
    header('location:user-login.php'); // Redirect to login if not logged in
    exit;
}

$user_email = $_SESSION['user_email'];

// Fetch user details from the database
$query = "SELECT * FROM users WHERE email = '$user_email'";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

// Default profile picture if none is set
$profile_picture = $user['profile_picture'] ?? 'img/default-profile.jpeg';
$name = $user['name'];

// Handle form submission
if (isset($_POST['update-profile'])) {
    $updated_name = mysqli_real_escape_string($conn, $_POST['name']);

    // Handle profile picture upload
    if (!empty($_FILES['profile_picture']['name'])) {
        $profile_pic_name = time() . '_' . $_FILES['profile_picture']['name']; // Add timestamp to avoid conflicts
        $profile_pic_tmp = $_FILES['profile_picture']['tmp_name'];
        $profile_pic_path = 'img/uploads/' . $profile_pic_name;

        // Move the uploaded file
        if (move_uploaded_file($profile_pic_tmp, $profile_pic_path)) {
            $profile_picture = $profile_pic_path;
        }
    }

    // Update user data in the database
    $update_query = "UPDATE users SET 
                        name = '$updated_name', 
                        profile_picture = '$profile_picture' 
                     WHERE email = '$user_email'";
    
    if (mysqli_query($conn, $update_query)) {
        // Update session variables to reflect changes
        $_SESSION['user_name'] = $updated_name;
        $_SESSION['profile_picture'] = $profile_picture;

        header('location:profile.php'); // Redirect to the profile page
        exit;
    } else {
        $error_message = "Failed to update profile. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <link href='https://fonts.googleapis.com/css?family=Bebas Neue' rel='stylesheet'>
    <title>Edit Profile</title>
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
            <form method="POST" enctype="multipart/form-data">
                <div class="profile-image">
                    <img src="<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture">
                    <input type="file" name="profile_picture" accept="image/*">
                </div>
                <div class="input-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
                </div>
                <button type="submit" name="update-profile" class="edit-profile-btn">Update Profile</button>
                <?php if (isset($error_message)): ?>
                    <p class="error-message"><?php echo $error_message; ?></p>
                <?php endif; ?>
            </form>
        </div>
    </section>
</body>

</html>
