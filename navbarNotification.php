<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

include "config.php";

$totalNotification = 0;

if(isset($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];

    // Pending booking untuk seller
    $pendingQuery = mysqli_query(

    $conn,

    "SELECT COUNT(*) AS total
     FROM booking_order
     WHERE provider_id = '$user_id'
     AND status = 'Pending'"

    );

    $pendingData = mysqli_fetch_assoc($pendingQuery);

    $pendingCount = $pendingData['total'];

    // Review reminder untuk buyer
    $reviewQuery = mysqli_query(

    $conn,

    "SELECT COUNT(*) AS total
     FROM booking_order
     WHERE user_id = '$user_id'
     AND status = 'Completed'
     AND booking_id NOT IN(
        SELECT booking_id
        FROM review
     )"

    );

    $reviewData = mysqli_fetch_assoc($reviewQuery);

    $reviewCount = $reviewData['total'];

    // Jumlah notification
    $totalNotification =

    $pendingCount +

    $reviewCount;

}

?>