<?php

session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$bankName = $_POST['bankName'];
$bankAccount = $_POST['bankAccount'];

$qrName = "";

if(!empty($_FILES['paymentQR']['name'])){

    $qrName = $_FILES['paymentQR']['name'];

    $tempQR = $_FILES['paymentQR']['tmp_name'];

    move_uploaded_file(
        $tempQR,
        "uploads/payment/" . $qrName
    );

    mysqli_query(
        $conn,
        "UPDATE userr
         SET
         bank_name='$bankName',
         bank_account='$bankAccount',
         payment_qr='$qrName'
         WHERE user_id='$user_id'"
    );

}
else{

    mysqli_query(
        $conn,
        "UPDATE userr
         SET
         bank_name='$bankName',
         bank_account='$bankAccount'
         WHERE user_id='$user_id'"
    );

}

header("Location:userProfile.php");
exit();