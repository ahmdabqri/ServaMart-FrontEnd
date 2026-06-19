<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}
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
    <div class = "logo">ServaMart</div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <button class="sell-button">SELL</button>

        <a href="#">
            <img src="image/profile-round-1342-svgrepo-com.svg">
            <span>Profile</span>
        </a>

        <a href="#">
            <img src="image/cart-shopping-svgrepo-com.svg">
            <span>Cart</span>
        </a>

        <a href="#">
            <img src="image/message-circle-chat-svgrepo-com.svg">
            <span>Message</span>
        </a>

        <a href="#">
            <img src="image/calendar-days-svgrepo-com.svg">
            <span>Booking</span>
        </a>
    </div>

</nav>
</header>
<body>
      
    <section class="cart-container">

    <h1>Shopping Cart</h1>

    <div class="cart-content">

        <div class="cart-items">

            <!--Item 1-->

            <div class="cart-item">

                <input type="checkbox"
                        class="item-checkbox"
                        data-price="300">

                <img src="image/product 3.jpg" alt="Desporte Futsal Shoes">

                <div class="item-details">

                    <h3>Desporte Futsal Shoes</h3>

                    <p class="price">RM 300.00</p>

                    <div class="quantity">

                        <button class="minus-btn">-</button>

                        <span class="qty">1</span>

                        <button class="plus-btn">+</button>

                    </div>

                    <button class="remove-btn">
                        Remove
                    </button>

                </div>

            </div>

            <!-- Item 2 -->
            <div class="cart-item">

                <input type="checkbox"
                       class="item-checkbox"
                       data-price="50">

                <img src="image/product 1.jpg"
                     alt="Gaming Mouse">

                <div class="item-details">

                    <h3>Gaming Mouse</h3>

                    <p class="price">RM 50.00</p>

                    <div class="quantity">

                        <button class="minus-btn">-</button>

                        <span class="qty">1</span>

                        <button class="plus-btn">+</button>

                    </div>

                    <button class="remove-btn">
                        Remove
                    </button>

                </div>

            </div>

        </div>

            

        <div class="cart-summary">

            <h2>Order Summary</h2>

             <p>Total: RM <span id="totalPrice">0.00</span></p>

            <a href="checkOut.html"><button class="checkout-btn">
                Checkout
            </button></a>

        </div>

    </div>

</section>

<script src="cart.js"></script>
    
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