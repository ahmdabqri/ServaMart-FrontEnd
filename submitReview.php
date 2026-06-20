<?php

session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];
$service_id = $_POST['service_id'];
$rating = $_POST['rating'];
$comment = $_POST['comment'];
$booking_id = $_POST['booking_id'];

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