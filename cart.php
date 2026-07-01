<?php

session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

include 'config.php';
include 'navbarNotification.php';

$user_id = $_SESSION['user_id'];

$query = mysqli_query(
    $conn,
    "SELECT cart.*,
            preloved_product.*
     FROM cart
     JOIN preloved_product
     ON cart.preloved_id = preloved_product.preloved_id
     WHERE cart.user_id = '$user_id'"
);

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
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="cart.css">
    

    <title>Product Detail </title>
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
      
    <section class="cart-container">

    <h1>Shopping Cart</h1>

    <form action="checkOut.php" method="POST">

        <div class="cart-content">

            <div class="cart-items">

                <?php while($row = mysqli_fetch_assoc($query)){ ?>

            <div class="cart-item">

            <input
                type="checkbox"
                name="selected_items[]"
                value="<?php echo $row['cart_id']; ?>"
                class="item-checkbox"
                data-price="<?php echo $row['price']; ?>">

                <img src="uploads/<?php echo $row['image']; ?>">

            <div class="item-details">

                <h3><?php echo $row['name']; ?></h3>

                <p>RM <?php echo number_format($row['price'],2); ?></p>

                <button type="button" class="remove-btn" onclick="window.location.href='remove-cart.php?id=<?php echo $row['cart_id']; ?>'">Remove</button>

    </div>

</div>

<?php } ?>

</div>

<div class="cart-summary">

    <h2>Order Summary</h2>

    <p>Total: RM <span id="totalPrice">0.00</span></p>

    <button type="submit" class="checkout-btn">
        Checkout
    </button>

</div>

</form>

</section>

<script src="cart.js"></script>
    
</body>

<footer class="footer">
    <div class="footer-left">
        <p>&#169 2026 UTeM ServaMart </p>
    </div>
    
</footer>
</html>