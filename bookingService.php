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
    

    <title>My Bookings Page ServaMart</title>
</head>

<header>
<nav class = "navbar">
    <div class = "logo">ServaMart</div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <a href="sell.html"><button class="sell-button">SELL</button></a>

        <a href="userProfile.html">
            <img src="image/profile-round-1342-svgrepo-com.svg">
            <span>Profile</span>
        </a>

        <a href="cart.html">
            <img src="image/cart-shopping-svgrepo-com.svg">
            <span>Cart</span>
        </a>

        <a href="chat.html">
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

    <section class="booking-container">

    <div class="booking-card">

        <h1>Book Service</h1>
        <br>

        <div class="service-summary">

            <img src="image/service 2.jpg " alt="Laundry" class="service-image">

            <div class="service-info">
            <h3>Laundry Service</h3>

            <div class="service-rating">⭐ 4.8 (25 Reviews)</div>

            <p><strong>Provider :</strong> Ahmad</p>
            
            <p><strong>Location :</strong> UTeM Main Campus</p>

            <p class="service-price">RM15.00 / 8kg</p>
            </div>

        </div>

        <div class="form-group">
            <label>Select Date</label>
            <input type="date" id="bookingDate">
            <small id="dateError" class="error"></small>
        </div>

        <div class="form-group">
            <label>Available Slots</label>

            <div class="slot-grid">

                

                <button class="slot-btn">9.00 AM</button>

                <button class="slot-btn unavailable">
                    10.00 AM
                </button>

                <button class="slot-btn">11.00 AM</button>

                <button class="slot-btn">12.00 PM</button>

                <button class="slot-btn unavailable">
                    1.00 PM
                </button>

                <button class="slot-btn">2.00 PM</button>

                <button class="slot-btn">3.00 PM</button>

                <button class="slot-btn">4.00 PM</button>

            </div>

            <p id="selectedSlotText"></p>

            <small id="slotError" class="error"></small>

        </div>

        <button id="bookBtn"
                class="book-btn">

            Book Service

        </button>

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