<?php
include "config.php";

$id = $_GET['id'];

mysqli_query($conn,
"UPDATE userr
SET status='Inactive'
WHERE user_id='$id'");

header("Location: adminDashboard.php");
exit();
?>