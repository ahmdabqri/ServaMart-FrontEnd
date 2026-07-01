<?php

session_start();
include 'config.php';

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}


$user_id = $_SESSION['user_id'];

$preloved_id = $_GET['id'];


// check kalau dah ada dalam cart

$check = mysqli_query(
    $conn,
    "SELECT * FROM cart
     WHERE user_id='$user_id'
     AND preloved_id='$preloved_id'"
);


if(mysqli_num_rows($check) > 0){

    echo "
    <script>
    alert('Item already in cart');
    window.location.href='cart.php';
    </script>
    ";

}
else{


    mysqli_query(
        $conn,
        "INSERT INTO cart
        (
            user_id,
            preloved_id
        )
        VALUES
        (
            '$user_id',
            '$preloved_id'
        )"
    );


    echo "
    <script>
    alert('Added to cart');
    window.location.href='cart.php';
    </script>
    ";

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add To Cart</title>
</head>
<body>
    
</body>
</html>