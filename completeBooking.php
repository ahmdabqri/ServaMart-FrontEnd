<?php

include 'config.php';

$booking_id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE booking_order
     SET status = 'Completed'
     WHERE booking_id = '$booking_id'"
);

header("Location: userProfile.php");
exit();

?>