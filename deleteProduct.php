<?php

session_start();

if($_SESSION['role'] != 'admin'){
    header("Location: login.php");
    exit();
}

include 'config.php';

$preloved_id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM preloved_product
     WHERE preloved_id = '$preloved_id'"
);

header("Location: adminDashboard.php");
exit();

?>