<?php

include "config.php";

$id = $_GET['id'];

mysqli_query(

$conn,

"DELETE FROM booking_order
WHERE booking_id='$id'"

);

header("Location: adminDashboard.php");
exit();

?>