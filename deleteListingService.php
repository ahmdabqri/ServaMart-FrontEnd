<?php

session_start();

include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$service_id = $_GET['id'];

/* Check kalau service ni dah pernah dibooking */

$bookingCheck = mysqli_query(

$conn,

"SELECT *

FROM booking_order

WHERE service_id = '$service_id'"

);

if(mysqli_num_rows($bookingCheck) > 0){

    echo "<script>

    alert('This service cannot be deleted because it already has bookings.');

    window.location='userProfile.php';

    </script>";

    exit();

}

/* Ambil nama gambar */

$imageQuery = mysqli_query(

$conn,

"SELECT image

FROM service_product

WHERE service_id = '$service_id'

AND user_id = '$user_id'"

);

$service = mysqli_fetch_assoc($imageQuery);

/* Delete gambar */

if(

$service['image'] != "" &&

file_exists("uploads/".$service['image'])

){

    unlink("uploads/".$service['image']);

}

/* Delete service */

mysqli_query(

$conn,

"DELETE FROM service_product

WHERE service_id = '$service_id'

AND user_id = '$user_id'"

);

header("Location:userProfile.php");

exit();

?>