<?php

session_start();
include 'config.php';
include "navbarNotification.php";

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
    <div class = "logo">
        <a href="homepage.php">
            <img src="image/logo.png" alt="ServaMart Logo">
        </a>
    </div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <a href="sell.php"><button class="sell-button">SELL</button></a>

 <a href="userProfile.php">

            <div class="profile-icon">

            <img src="image/profile-round-1342-svgrepo-com.svg">
        

            <?php
            if($totalNotification > 0){
            ?>

                <span class="profile-badge">
                    <?php echo $totalNotification; ?>
                </span>

            <?php
            }
            ?>

        </div>

        <span>Profile</span>

        </a>

        <a href="cart.php">
            <img src="image/cart-shopping-svgrepo-com.svg">
            <span>Cart</span>
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

    
</footer>
</html>