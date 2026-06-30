<?php

include "config.php";

$id = $_GET['id'];

mysqli_query(
    $conn,
    "UPDATE userr
     SET status='Active'
     WHERE user_id='$id'"
);

header("Location: adminDashboard.php");
exit();

?>