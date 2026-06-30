<?php
session_start();
include 'config.php';
include "navbarNotification.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
?>

<?php

$items = [];

/* PRELOVED */
$productQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM preloved_product
     WHERE listing_status='Active'
     ORDER BY created_at DESC"
);

while($row = mysqli_fetch_assoc($productQuery)){

    $row['type'] = 'product';

    $items[] = $row;
}

/* SERVICE */
$serviceQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM service_product
     WHERE status='Available'
     AND listing_status='Active'
     ORDER BY created_at DESC"
);

while($row = mysqli_fetch_assoc($serviceQuery)){

    $row['type'] = 'service';

    $items[] = $row;
}

usort($items, function($a, $b){
    return strtotime($b['created_at'])
         - strtotime($a['created_at']);
});

$productSpotlightQuery = mysqli_query(

$conn,

"SELECT *
FROM preloved_product
WHERE listing_status='Active'
ORDER BY preloved_id DESC
LIMIT 1"

);

$productSpotlight =
mysqli_fetch_assoc($productSpotlightQuery);

$serviceSpotlightQuery = mysqli_query(

$conn,

"SELECT
service_product.*,
COUNT(booking_order.booking_id) AS total_booking

FROM service_product

LEFT JOIN booking_order
ON service_product.service_id = booking_order.service_id

WHERE service_product.status='Available'
AND service_product.listing_status='Active'
GROUP BY service_product.service_id

ORDER BY total_booking DESC

LIMIT 1"

);

$serviceSpotlight =
mysqli_fetch_assoc($serviceSpotlightQuery);

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
    <link rel="stylesheet" href="category.css">
    <link rel="stylesheet" href="spotlight.css">
    

    <title>Home Page ServaMart</title>
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
      
    <div class="servamart-bg">

        <!--Spotlight Section-->

        <section class="spotlight-section">

        <a href="product-detail.php?id=<?php echo $productSpotlight['preloved_id']; ?>">

        <div class="spotlight-card">

        <div class="spotlight-image">

            <img src="uploads/<?php echo $productSpotlight['image']; ?>">

        </div>

        <div class="spotlight-info">

            <h2>
                <?php echo $productSpotlight['name']; ?>
            </h2>

            <p>
                Recently Added
            </p>

        </div>

    </div>

        </a>


    <a href="service-detail.php?id=<?php echo $serviceSpotlight['service_id']; ?>">
    <div class="spotlight-card">

        <div class="spotlight-image">

            <img src="uploads/<?php echo $serviceSpotlight['image']; ?>">
        </div>

        <div class="spotlight-info">

            <h2>
                <?php echo $serviceSpotlight['name']; ?>
            </h2>

            <p>
                Most Booked Service
                <?php echo $serviceSpotlight['total_booking']; ?>
                Bookings
            </p>

        </div>

    </div>
    </a>

</section>

        <!--Category Section-->
        <section class="category-section">

            <a href="PrelovedItemList.php" class="category-link">
            <div class="category-card">
                <div class="category-icon"><img src="image/preloved.jpg"></div>
                <h3>Preloved</h3>
            </div>
            </a>

            <a href="ServiceList.php" class="category-link">
            <div class="category-card">
                <div class="category-icon"><img src="image/service.jpg"></div>
                <h3>Service</h3>
            </div>
            </a>

        </section>

        <!--Product Grid-->
        <section class="product-section">

        <div class="product-grid">
            <p id="noResult" class="no-result">
                No product found
            </p>

            <?php foreach($items as $row){ ?>

<div class="product-card">

    <div class="product-image">

        <?php if($row['type'] == 'product'){ ?>

            <img src="uploads/<?php echo $row['image']; ?>">

        <?php } else { ?>

            <img src="uploads/<?php echo $row['image']; ?>">

        <?php } ?>

    </div>

    <h3><?php echo $row['name']; ?></h3>

    <p>RM <?php echo $row['price']; ?></p>

    <?php if($row['type'] == 'product'){ ?>

    <?php
if($row['status'] == "Available"){
?>
<a href="product-detail.php?id=<?php echo $row['preloved_id']; ?>">
    <button>Buy Now</button>
</a>
<?php
}
else{
?>

<button class="sold-btn" disabled>
    Sold Out
</button>

<?php
}
?>

<?php } else { ?>

<a href="service-detail.php?id=<?php echo $row['service_id']; ?>">
    <button>Book Now</button>
</a>

<?php } ?>

</div>

<?php } ?>

        </div>

    </section>

    </div>
      
    <script src="main.js"></script>
</body>

<footer class="footer">
    <div class="footer-left">
        <p>&#169 2026 UTeM ServaMart </p>
    </div>
    
</footer>
</html>