<?php

include "config.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE service_product
     SET listing_status = 'Active'
     WHERE service_id = '$id'"
);

header("Location: adminDashboard.php");
exit();

?>