<?php

session_start();

include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$preloved_id = $_GET['id'];

/* Check sama ada barang ni dah pernah diorder */

$orderCheck = mysqli_query(

$conn,

"SELECT *

FROM order_item

WHERE preloved_id = '$preloved_id'"

);

if(mysqli_num_rows($orderCheck) > 0){

    echo "<script>

    alert('This listing cannot be deleted because it already has orders.');

    window.location='userProfile.php';

    </script>";

    exit();

}

/* Kalau tiada order, baru delete */

mysqli_query(

$conn,

"DELETE FROM preloved_product

WHERE preloved_id = '$preloved_id'

AND user_id = '$user_id'"

);

header("Location:userProfile.php");

exit();

?>