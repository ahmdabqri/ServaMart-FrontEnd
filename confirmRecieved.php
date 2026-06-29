<?php

session_start();

include "config.php";

$user_id =
$_SESSION['user_id'];

$order_id =
$_GET['id'];

mysqli_query(

$conn,

"UPDATE order_table

SET payment_status='Completed'

WHERE order_id='$order_id'

AND user_id='$user_id'"

);

mysqli_query(

$conn,

"UPDATE preloved_product p

INNER JOIN order_item oi
ON p.preloved_id = oi.preloved_id

SET p.status='Sold Out'

WHERE oi.order_id='$order_id'"

);

header("Location:userProfile.php");

exit();

?>