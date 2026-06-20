<?php

session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$service_id =
$_POST['service_id'];

$provider_id =
$_POST['provider_id'];

$booking_date =
$_POST['booking_date'];

$booking_time =
$_POST['booking_time'];

$status = "Pending";

mysqli_query(
    $conn,
    "INSERT INTO booking_order
(
    booking_date,
    booking_time,
    status,
    user_id,
    provider_id,
    service_id
)
    VALUES
    (
        '$booking_date',
        '$booking_time',
        '$status',
        '$user_id',
        '$provider_id',
        '$service_id'
    )"
);



header("Location:userProfile.php");
exit();

?>