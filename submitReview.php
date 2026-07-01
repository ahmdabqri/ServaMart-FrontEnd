<?php

session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
$service_id = $_POST['service_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$booking_id = $_POST['booking_id'];

$bookingQuery = mysqli_query(

$conn,

"SELECT provider_id

FROM booking_order

WHERE booking_id = '$booking_id'"

);

$booking = mysqli_fetch_assoc($bookingQuery);

if($booking['provider_id'] == $_SESSION['user_id']){

    die("You cannot review your own service.");

}

mysqli_query(
    $conn,
    "INSERT INTO review
(
booking_id,
rating,
comment,
review_date,
user_id,
service_id
)
   VALUES
(
'$booking_id',
'$rating',
'$comment',
CURDATE(),
'$user_id',
'$service_id'
)"
);



header("Location:userProfile.php");

?>