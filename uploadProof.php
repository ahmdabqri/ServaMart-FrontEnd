<?php

session_start();

include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location:login.php");
    exit();
}

$order_id = $_POST['order_id'];

$imageName = "";

if($_FILES['delivery_proof']['name'] != ""){

    $imageName =
    time()."_".$_FILES['delivery_proof']['name'];

    move_uploaded_file(

        $_FILES['delivery_proof']['tmp_name'],

        "uploads/proof/".$imageName

    );

    mysqli_query(

    $conn,

    "UPDATE order_table

    SET delivery_proof = '$imageName'

    WHERE order_id = '$order_id'"

    );

}

header("Location:userProfile.php");

exit();

?>