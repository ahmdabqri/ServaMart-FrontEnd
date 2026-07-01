<?php

include "config.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE preloved_product
     SET listing_status='Active'
     WHERE preloved_id='$id'"
);

header("Location: adminDashboard.php");
exit();

?>