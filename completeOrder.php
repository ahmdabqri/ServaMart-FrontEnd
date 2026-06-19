<?php

include 'config.php';

$order_id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE order_table
     SET payment_status = 'Completed'
     WHERE order_id = '$order_id'"
);

header("Location: userProfile.php");
exit();

?>