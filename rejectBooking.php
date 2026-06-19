<?php

include 'config.php';

$id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE booking_order
     SET status = 'Cancelled'
     WHERE booking_id = '$id'"
);

header("Location:userProfile.php");
exit();

?>