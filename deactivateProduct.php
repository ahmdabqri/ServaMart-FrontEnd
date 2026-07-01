<?php

include "config.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE preloved_product
     SET listing_status='Inactive'
     WHERE preloved_id='$id'"
);

header("Location: adminDashboard.php");
exit();

?>