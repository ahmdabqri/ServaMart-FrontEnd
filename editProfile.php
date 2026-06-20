<?php

session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$userQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM userr
     WHERE user_id = '$user_id'"
);

$user = mysqli_fetch_assoc($userQuery);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="editProfile.css">
</head>
<header>
<nav class = "navbar">
    <div class = "logo">ServaMart</div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <a href="sell.php"><button class="sell-button">SELL</button></a>

        <a href="userProfile.php">
            <img src="image/profile-round-1342-svgrepo-com.svg">
            <span>Profile</span>
        </a>

        <a href="cart.php">
            <img src="image/cart-shopping-svgrepo-com.svg">
            <span>Cart</span>
        </a>

        <a href="chat.php">
            <img src="image/message-circle-chat-svgrepo-com.svg">
            <span>Message</span>
        </a>

        <a href="bookings.php">
            <img src="image/calendar-days-svgrepo-com.svg">
            <span>Booking</span>
        </a>
    </div>

</nav>
</header>
<body>

    <div class="edit-profile-container">

        <h1>Edit Profile</h1>

        <div class="profile-preview">

    <img
    src="image/profile-round-1342-svgrepo-com.svg"
    class="profile-preview-img">

</div>
        <form action="updateProfile.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">

            <label>Full Name</label>

            <input
            type="text"
            name="name"
            value="<?php echo $user['name']; ?>">

            </div>

            <div class="form-group">

            <label>Email</label>

            <input
            type="email"
            name="email"
            value="<?php echo $user['email']; ?>">

            </div>

            <div class="form-group">

            </div>

            <div class="form-group">

            <label>Profile Picture</label>

            <input
            type="file"
            name="profile_image">

            </div>

            <button
            type="submit"
            class="save-btn">

            Save Changes

            </button>

        </form>
    </div>
    
</body>
<footer class="footer">
    <div class="footer-left">
        <p>&#169 2026 UTeM ServaMart </p>
    </div>
    <div class="footer-right">
        <a href="#">Help Centre</a>
        <span>|</span>
        <a href="#">Contact Us</a>
    </div>
    
</footer>
</html>