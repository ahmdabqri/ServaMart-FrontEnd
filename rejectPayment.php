<?php

include 'config.php';

$order_id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE order_table
     SET payment_status = 'Cancelled'
     WHERE order_id = '$order_id'"
);

header("Location: adminDashboard.php");
exit();

?>