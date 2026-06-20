<?php

session_start();
include 'config.php';

$service_id = $_GET['id'];

$serviceQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM service_product
     WHERE service_id = '$service_id'"
);

$service = mysqli_fetch_assoc($serviceQuery);

$reviewQuery = mysqli_query(
    $conn,
    "SELECT
        AVG(rating) AS avg_rating,
        COUNT(review_id) AS total_reviews
     FROM review
     WHERE service_id = '".$service['service_id']."'"
);

$reviewData = mysqli_fetch_assoc($reviewQuery);

$avgRating =
number_format($reviewData['avg_rating'] ?? 0, 1);

$totalReviews =
$reviewData['total_reviews'] ?? 0;

$userQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM userr
     WHERE user_id = '".$service['user_id']."'"
);

$provider = mysqli_fetch_assoc($userQuery);

$slots = [
    "9.00 AM",
    "10.00 AM",
    "11.00 AM",
    "12.00 PM",
    "1.00 PM",
    "2.00 PM",
    "3.00 PM",
    "4.00 PM"
];

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
    <link rel="stylesheet" href="bookingService.css">
    

    <title> Bookings Page ServaMart</title>
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

    <section class="booking-container">

    <div class="booking-card">

        <h1>Book Service</h1>
        <br>

        <div class="service-summary">

            <img src="uploads/<?php echo $service['image']; ?>"class="service-image">

            <div class="service-info">
                
            <h3><?php echo $service['name']; ?></h3>

            <div class="service-rating">

                <?php
                if($totalReviews > 0){
                ?>

                ⭐ <?php echo $avgRating; ?>
                (<?php echo $totalReviews; ?> Reviews)

                <?php
                }
                else{
                ?>

                No Reviews Yet

                <?php
                }
                ?>

            </div>

            <p><strong>Provider :</strong> <?php echo $provider['name']; ?></p>
            
            <p><strong>Location :</strong> <?php echo $service['location']; ?></p>

            <p class="service-price">RM <?php echo number_format($service['price'],2); ?></p>

            </div>

        </div>

        <form action="processBooking.php" method="POST">

        <div class="form-group">
            <label>Select Date</label>
            <input type="date" name="booking_date" required>
            <input type="hidden" name="booking_time" id="bookingTime">
            <small id="dateError" class="error"></small>
        </div>

        <div class="form-group">
            <label>Available Slots</label>

            <div class="slot-grid">

               

                <button type="button" class="slot-btn">9.00 AM</button>

                <button type="button" class="slot-btn">10.00 AM</button>

                <button type="button" class="slot-btn">11.00 AM</button>

                <button type="button" class="slot-btn">12.00 PM</button>

                <button type="button" class="slot-btn">1.00 PM</button>

                <button type="button" class="slot-btn">2.00 PM</button>

                <button type="button" class="slot-btn">3.00 PM</button>

                <button type="button" class="slot-btn">4.00 PM</button>

            </div>

            <p id="selectedSlotText"></p>

            <small id="slotError" class="error"></small>

        </div>

        <input type="hidden" name="service_id" value="<?php echo $service['service_id']; ?>">
        <input type="hidden" name="provider_id" value="<?php echo $service['user_id']; ?>">

        <button type="submit" id="bookBtn" class="book-btn"> Book Service </button>

        </form>

    </div>

</section>
 
<script src="bookingService.js"></script>
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