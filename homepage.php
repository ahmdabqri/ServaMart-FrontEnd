<?php
session_start();
include 'config.php';

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
    "SELECT * FROM preloved_product
    WHERE status='Available'
    ORDER BY created_at DESC"
);

while($row = mysqli_fetch_assoc($productQuery)){

    $row['type'] = 'product';

    $items[] = $row;
}

/* SERVICE */
$serviceQuery = mysqli_query(
    $conn,
    "SELECT * FROM service_product
WHERE status='Available'
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
      
    <div class="servamart-bg">

        <!--Spotlight Section-->

        <section class="spotlight-section">

            <div class="spotlight-card">
                <div class="spotlight-image"><img src="image/product 1.jpg" alt="Spotlight Product"></div>

                <div class="spotlight-info">
                    <h2>Gaming Mouse</h2>
                    <p>Best Seller Product</p>
                </div>
            </div>

            <div class="spotlight-card">
                <div class="spotlight-image"><img src="image/service 1.jpg" alt="Spotlight Service"></div>

                <div class="spotlight-info">
                    <h2>Tutor Programming</h2>
                    <p>Popular Service</p>
                </div>
            </div>

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

<a href="product-detail.php?id=<?php echo $row['preloved_id']; ?>">
    <button>View Details</button>
</a>

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
    <div class="footer-right">
        <a href="#">Help Centre</a>
        <span>|</span>
        <a href="#">Contact Us</a>
    </div>
    
</footer>
</html>