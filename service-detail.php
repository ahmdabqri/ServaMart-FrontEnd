<?php

session_start();
include 'config.php';
include "navbarNotification.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$service_id = $_GET['id'];

$query = mysqli_query(
    $conn,
    "SELECT service_product.*, userr.name AS seller_name
     FROM service_product
     JOIN userr
     ON service_product.user_id = userr.user_id
     WHERE service_id = '$service_id'"
);

$service = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="card.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="productDetail.css">
    <link rel="stylesheet" href="spotlight.css">
    

    <title>Service Detail </title>
</head>

<header>
<nav class = "navbar">
    <div class = "logo">ServaMart</div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <button class="sell-button">SELL</button>

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
      
    <section class="product-detail-container">

    <div class="product-gallery">

        <img src="uploads/<?php echo $service['image']; ?>" class="main-image">

        <!--
        <div class="thumbnail-container">
            <img src="image/product 3.jpg" class="thumbnail">
            <img src="image/product detail 1.webp" class="thumbnail">
            <img src="image/product detail 2.webp" class="thumbnail">
            <img src="image/product detail 3.webp" class="thumbnail">
        </div> -->

    </div>

    <div class="product-info">

        <h1><?php echo $service['name']; ?></h1>

        <p class="price">RM <?php echo number_format($service['price'],2); ?></p>

        <p>Provider : <?php echo $service['seller_name']; ?></p>

        <p>Availability : <?php echo $service['availability']; ?></p>

        <p>Location : <?php echo $service['location']; ?></p>

        <div class="description">
            <h3>Description</h3>

            <p><?php echo nl2br($service['description']); ?></p>
        </div>

        <div class="action-button">

        <a  href="bookingService.php?id=<?php echo $service['service_id']; ?>"
        ><button class="cart-btn">
            Book Service
        </button></a>

        </div>

    </div>

</section>
    
<script src="productDetail.js"></script>
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