<?php

include "config.php";

$id = $_GET['id'];

$query = mysqli_query(

$conn,

"SELECT

booking_order.*,

userr.name AS customer_name,
userr.email,

service_product.name AS service_name,
service_product.price,

provider.name AS provider_name

FROM booking_order

INNER JOIN userr
ON booking_order.user_id = userr.user_id

INNER JOIN service_product
ON booking_order.service_id = service_product.service_id

INNER JOIN userr provider
ON booking_order.provider_id = provider.user_id

WHERE booking_order.booking_id='$id'"

);

$booking = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin View Booking</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="viewBooking.css">
</head>
<body>

<h2>

Booking Details

</h2>

<div class="booking-card">

<p>

<b>Booking ID :</b>

<?php echo $booking['booking_id']; ?>

</p><hr>

<p>

<b>Customer :</b>

<?php echo $booking['customer_name']; ?>

</p><hr>

<p>

<b>Email :</b>

<?php echo $booking['email']; ?>

</p><hr>

<p>

<b>Provider :</b>

<?php echo $booking['provider_name']; ?>

</p><hr>

<p>

<b>Service :</b>

<?php echo $booking['service_name']; ?>

</p><hr>

<p>

<b>Price :</b>

RM <?php echo number_format($booking['price'],2); ?>

</p><hr>

<p>

<b>Booking Date :</b>

<?php echo $booking['booking_date']; ?>

</p>

<p>

<b>Status :</b>

<span class="status-badge
<?php echo strtolower(str_replace(' ','-',$booking['status'])); ?>">

<?php echo $booking['status']; ?>

</span>

</p>

<a href="adminDashboard.php">

<button>

Back

</button>

</a>
    
</body>
</html>