    <?php
    session_start();
    include 'config.php';

    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
        exit();
    }

    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM userr
            WHERE user_id = '$user_id'";

    $result = mysqli_query($conn,$sql);

    $user = mysqli_fetch_assoc($result);

    $purchaseQuery = mysqli_query(
        $conn,
        "SELECT *
        FROM order_table
        WHERE user_id = '$user_id'
        ORDER BY order_date DESC"
    );

    $listingQuery = mysqli_query(
        $conn,
        "SELECT *
        FROM preloved_product
        WHERE user_id = '$user_id'"
    );

    $sellerOrderQuery = mysqli_query(
    $conn,
    "SELECT
        order_table.order_id,
        order_table.payment_status,
        order_table.full_name,
        preloved_product.name,
        preloved_product.price,
        preloved_product.image
     FROM order_table
     JOIN order_item
        ON order_table.order_id = order_item.order_id
     JOIN preloved_product
        ON order_item.preloved_id = preloved_product.preloved_id
     WHERE preloved_product.user_id = '$user_id'
     AND order_table.payment_status = 'In Progress'"
);

$bookingQuery = mysqli_query(
    $conn,
    "SELECT booking_order.*,
            service_product.name AS service_name
     FROM booking_order
     INNER JOIN service_product
     ON booking_order.service_id =
        service_product.service_id
     WHERE booking_order.user_id = '$user_id'
     ORDER BY booking_order.booking_date DESC"
);

$incomingBookingQuery = mysqli_query(
    $conn,
    "SELECT booking_order.*,
            service_product.name AS service_name,
            userr.name AS customer_name
     FROM booking_order

     INNER JOIN service_product
     ON booking_order.service_id =
        service_product.service_id

     INNER JOIN userr
     ON booking_order.user_id =
        userr.user_id

     WHERE booking_order.provider_id =
           '$user_id'

     ORDER BY booking_order.booking_date DESC"
);

$ratingQuery = mysqli_query(
    $conn,
    "SELECT
        AVG(rating) AS avg_rating,
        COUNT(review_id) AS total_reviews
     FROM review
     WHERE service_id IN
     (
         SELECT service_id
         FROM service_product
         WHERE user_id = '$user_id'
     )"
);

$ratingData = mysqli_fetch_assoc($ratingQuery);

$avgRating =
number_format($ratingData['avg_rating'] ?? 0,1);

$totalReviews =
$ratingData['total_reviews'] ?? 0;

$reviewQuery = mysqli_query(
$conn,

"SELECT
review.*,
userr.name AS user_name,
service_product.name AS service_name

FROM review

LEFT JOIN userr
ON review.user_id = userr.user_id

LEFT JOIN service_product
ON review.service_id = service_product.service_id

WHERE review.service_id IN (

    SELECT service_id
    FROM service_product
    WHERE user_id = '$user_id'

)

ORDER BY review.review_date DESC"
);

$listingCountQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM service_product
     WHERE user_id = '$user_id'"
);

$listingData = mysqli_fetch_assoc($listingCountQuery);

$totalListings = $listingData['total'];

$reviewCountQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM review r
     INNER JOIN service_product s
     ON r.service_id = s.service_id
     WHERE s.user_id = '$user_id'"
);

$reviewCountData =
mysqli_fetch_assoc($reviewCountQuery);

$totalReviews =
$reviewCountData['total'];

$bookingCountQuery = mysqli_query(
    $conn,
    "SELECT COUNT(*) AS total
     FROM booking_order
     WHERE provider_id = '$user_id'
     AND status = 'Completed'"
);

$bookingCountData =
mysqli_fetch_assoc($bookingCountQuery);

$totalBookings =
$bookingCountData['total'];

$revenueQuery = mysqli_query(

$conn,

"SELECT SUM(s.price) AS revenue

 FROM booking_order b

 INNER JOIN service_product s
 ON b.service_id = s.service_id

 WHERE b.provider_id = '$user_id'

 AND b.status = 'Completed'"

);

$revenueData =
mysqli_fetch_assoc($revenueQuery);

$revenue =
$revenueData['revenue'] ?? 0;

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
    <link rel="stylesheet" href="userProfile.css">
    <link rel="stylesheet" href="userProfile(insights).css">
    <link rel="stylesheet" href="userProfile(reviews).css">
    <link rel="stylesheet" href="userProfile(purchases).css">
    <link rel="stylesheet" href="userProfile(bookings).css">
    <link rel="stylesheet" href="userProfile(payment).css">


    

    <title>User Profile Page ServaMart</title>
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

        <a href="#">
            <img src="image/profile-round-1342-svgrepo-com.svg">
            <span><?php echo $_SESSION['name']; ?></span>
        </a>

        <a href="cart.html">
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
      
    <section class="profile-container">

    <div class="profile-card">

        <div class="profile-left">

<?php
if(!empty($user['profile_image'])){
?>

<img
src="uploads/<?php echo $user['profile_image']; ?>"
class="profile-img">

<?php
}else{
?>

<img
src="image/profile-round-1342-svgrepo-com.svg"
class="profile-img">

<?php
}
?>

        </div>

        <div class="profile-info">

            <h2><?php echo $user['name']; ?></h2>

            <p><?php echo $user['email']; ?></p>

            <p>UTeM ServaMart Member</p>

            <div class="profile-stats">
                <?php if($totalReviews > 0){
                        echo "⭐ ".$avgRating." Rating";
                       }
                     else{ echo "No Ratings Yet"; } ?>
                
                <span><?php echo $totalReviews; ?> Reviews</span>

            </div>

        </div>

        <a href="editProfile.php">
        <button class="edit-profile-btn">Edit Profile</button>
        </a>

    </div>

    <div class="profile-tabs">

        <button id="listingsTab" class="tab-btn active">
            Listings
        </button>

        <button id="insightsTab" class="tab-btn">
            Insights
        </button>

        <button id="reviewsTab" class="tab-btn">
            Reviews
        </button>

        <button id="purchasesTab" class="tab-btn">
            Purchases
        </button>

        <button id="bookingsTab" class="tab-btn">
            Bookings
        </button>

        <button id="incomingTab" class="tab-btn">Incoming Bookings</button>

        <button id="paymentTab" class="tab-btn">
            Payment Info
        </button>

    </div>

   <div class="profile-content">

    <div id="listingsContent" class="tab-content active-content">

        <h2>My Listings</h2>

        <div class="listing-grid">

            <?php
            while($product = mysqli_fetch_assoc($listingQuery)){
            ?>

                <div class="listing-card">

                    <img
                        src="uploads/<?php echo $product['image']; ?>"
                        alt="Product">

                    <div class="listing-info">

                        <h3><?php echo $product['name']; ?></h3>

                        <p>
                            RM <?php echo number_format($product['price'],2); ?>
                        </p>

                    </div>

                </div>

            <?php
            }
            ?>

        </div>

        <br><br>
        <h2>Orders To Complete</h2>

<div class="listing-grid">

<?php
while($order = mysqli_fetch_assoc($sellerOrderQuery)){
?>

<div class="listing-card">

    <img
        src="uploads/<?php echo $order['image']; ?>"
        alt="Product">

    <div class="listing-info">

        <h3>
            <?php echo $order['name']; ?>
        </h3>

        <p>
            Buyer:
            <?php echo $order['full_name']; ?>
        </p>

        <p>
            Status:
            <?php echo $order['payment_status']; ?>
        </p>

        <a href="completeOrder.php?id=<?php echo $order['order_id']; ?>">

            <button class="complete-btn">
                Mark As Completed
            </button>

        </a>

    </div>

</div>

<?php
}
?>

</div>

    </div>

    <div id="insightsContent" class="tab-content">

        <h2>Insights</h2>

         <div class="insight-grid">

        <div class="insight-card">
            <span>📦</span>
            <h3>Total Listings</h3>
            <p><?php echo $totalListings; ?></p>
        </div>

        <div class="insight-card">
            <span>⭐</span>
            <h3>Total Reviews</h3>
            <p><?php echo $totalReviews; ?></p>
        </div>

        <div class="insight-card">
            <span>🛒</span>
            <h3>Revenue</h3>
            <p>RM <?php echo number_format($revenue,2); ?></p>
        </div>

        <div class="insight-card">
            <span>📅</span>
            <h3>Bookings</h3>
            <p><?php echo $totalBookings; ?></p>
        </div>

    </div>


    </div>

    <div id="reviewsContent" class="tab-content">

        <h2>Reviews</h2>

        <div class="review-list">

<?php
while($review = mysqli_fetch_assoc($reviewQuery)){
?>

<div class="review-card">

    <div class="service-title">

    <?php echo $review['service_name']; ?>

    </div>

    <div class="review-header">

        <h3>
            <?php echo $review['user_name']; ?>
        </h3>

        <span class="review-rating">

            <?php

            for($i=1; $i<=5; $i++){

                if($i <= $review['rating']){

                    echo "⭐";

                }else{

                    echo "☆";

                }

            }

            ?>

        </span>

    </div>

    <p class="review-comment">

        <?php echo $review['comment']; ?>

    </p>

    <small>

        <?php echo $review['review_date']; ?>

    </small>

</div>

<?php
}
?>

</div>
    </div>

    <div id="purchasesContent" class="tab-content">
        <h2>Purchases</h2>
         <div class="purchase-status">

         <button class="purchase-btn active-purchase" data-status="all">
    All
</button>

        <button class="purchase-btn" data-status="pending-verification">
    Pending Verification
</button>

<button class="purchase-btn" data-status="in-progress">
    In Progress
</button>

<button class="purchase-btn" data-status="completed">
    Completed
</button>

<button class="purchase-btn" data-status="cancelled">
    Cancelled
</button>

    </div>

    <div class="purchase-list">

<?php

if(mysqli_num_rows($purchaseQuery) > 0){

    while($order = mysqli_fetch_assoc($purchaseQuery)){

?>

<div
    class="purchase-card"
    data-status="<?php echo strtolower(str_replace(' ','-',$order['payment_status'])); ?>">

    <div class="purchase-info">

        <h3>
            Order #<?php echo $order['order_id']; ?>
        </h3>

        <p>
            RM <?php echo number_format($order['total_amount'],2); ?>
        </p>

        <p>
            <?php echo $order['order_date']; ?>
        </p>

        <span class="status">
            <?php echo $order['payment_status']; ?>
        </span>

    </div>

</div>

<?php

    }

}else{

    echo "<p>No purchases yet.</p>";

}

?>

</div>
    </div>

    <div id="bookingsContent" class="tab-content">

        <h2>Bookings</h2>

        <table class="booking-table">

        <thead>

            <tr>
                <th>Service</th>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

<?php
while($booking = mysqli_fetch_assoc($bookingQuery)){
?>

<tr>

    <td>
        <?php echo $booking['service_name']; ?>
    </td>

    <td>
        BK<?php echo $booking['booking_id']; ?>
    </td>

    <td>
        <?php echo $booking['booking_date']; ?>
    </td>

    <td>
        <?php echo $booking['booking_time']; ?>
    </td>

    <?php

$checkReview = mysqli_query(
    $conn,
    "SELECT *
     FROM review
     WHERE booking_id = '".$booking['booking_id']."'"
);

$alreadyReviewed =
mysqli_num_rows($checkReview);

?>

    <td>

        <span class="status
        <?php echo strtolower($booking['status']); ?>">

            <?php echo $booking['status']; ?>

        </span>

    </td>

    <td>

<?php
if(
    $booking['status'] == 'Completed' && $alreadyReviewed == 0
){
?>

<a href="reviewService.php?
   service_id=<?php echo $booking['service_id']; ?>
   &booking_id=<?php echo $booking['booking_id']; ?>">

    <button class="review-btn">Leave Review</button>
</a>

<?php
}
elseif($alreadyReviewed > 0){
?>

<span class="reviewed-badge">
    Reviewed
</span>

<?php
}
?>

</td>

</tr>

<?php
}
?>

</tbody>

    </table>

    </div>

    <div id="incomingContent" class="tab-content">

<h2>Incoming Bookings</h2>

<table class="booking-table">

<thead>

<tr>

<th>Customer</th>
<th>Service</th>
<th>Date</th>
<th>Time</th>
<th>Status</th>
<th>Action</th>

</tr>

</thead>

<tbody>

<?php
while($incoming = mysqli_fetch_assoc($incomingBookingQuery)){
?>

<tr>

<td>
    <?php echo $incoming['customer_name']; ?>
</td>

<td>
    <?php echo $incoming['service_name']; ?>
</td>

<td>
    <?php echo $incoming['booking_date']; ?>
</td>

<td>
    <?php echo $incoming['booking_time']; ?>
</td>

<td>
    <?php echo $incoming['status']; ?>
</td>

<td>

<?php
if($incoming['status'] == 'Pending'){
?>

<div class="action-buttons">

<a href="approveBooking.php?id=<?php echo $incoming['booking_id']; ?>">

<button class="approve-btn">Approve</button>

</a>

<a href="rejectBooking.php?id=<?php echo $incoming['booking_id']; ?>">

<button class="reject-btn">Reject</button>

</a>

</div>

<?php   } elseif($incoming['status'] == 'Confirmed'){ ?>

<a href="completeBooking.php?id=<?php echo $incoming['booking_id']; ?>">

<button class="complete-btn"> Complete </button>

</a>

<?php
}
?>

</td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

    <div id="paymentContent" class="tab-content">

    <h2>Payment Information</h2>

    <form action="update-payment.php" method="POST" enctype="multipart/form-data">

        <div class="form-group">

            <label>Bank Name</label>

            <input
                type="text"
                name="bankName"
                value="<?php echo $user['bank_name'] ?? ''; ?>">

        </div>

        <div class="form-group">

            <label>Account Number</label>

            <input
                type="text"
                name="bankAccount"
                value="<?php echo $user['bank_account'] ?? ''; ?>">

        </div>

        <div class="form-group">

            <label>Payment QR</label>

            <input
                type="file"
                name="paymentQR"
                accept="image/*">

        </div>

        <?php
        if(!empty($user['payment_qr'])){
        ?>

        <img
            src="uploads/payment/<?php echo $user['payment_qr']; ?>"
            width="200">

        <?php
        }
        ?>

        <button type="submit">
            Save Payment Info
        </button>

    </form>

</div>
</div>

</section>
  
<script src="userProfile.js"></script>
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