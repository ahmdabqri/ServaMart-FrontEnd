<?php

session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

include 'config.php';

$service_id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM service_product
     WHERE service_id = '$service_id'"
);

header("Location: adminDashboard.php");
exit();

?>