<?php

include 'config.php';

$date = $_GET['date'];
$service_id = $_GET['service_id'];

$query = mysqli_query(

$conn,

"SELECT booking_time
 FROM booking_order

 WHERE booking_date = '$date'
 AND service_id = '$service_id'
 AND status != 'Cancelled'"

);

$slots = [];

while($row = mysqli_fetch_assoc($query)){

    $slots[] = trim($row['booking_time']);

}

echo json_encode($slots);

?>