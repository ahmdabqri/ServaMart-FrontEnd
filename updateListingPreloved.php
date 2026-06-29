<?php

session_start();

include 'config.php';

$user_id = $_SESSION['user_id'];

$preloved_id = $_POST['preloved_id'];

$name = $_POST['name'];

$price = $_POST['price'];

$description = $_POST['description'];

$imageQuery = mysqli_query(

$conn,

"SELECT image

FROM preloved_product

WHERE preloved_id = '$preloved_id'

AND user_id = '$user_id'"

);

$product = mysqli_fetch_assoc($imageQuery);

$imageName = $product['image'];

if($_FILES['image']['name'] != ""){

    $imageName = time()."_".$_FILES['image']['name'];

    if(

        move_uploaded_file(

            $_FILES['image']['tmp_name'],

            "uploads/".$imageName

        )

    ){

        if(

        $product['image'] != "" &&

        file_exists("uploads/".$product['image'])

        ){

            unlink("uploads/".$product['image']);

        }

    }

}

mysqli_query(

$conn,

"UPDATE preloved_product

SET

name = '$name',

price = '$price',

description = '$description',

image = '$imageName'

WHERE preloved_id = '$preloved_id'

AND user_id = '$user_id'"

);

header("Location:userProfile.php");

exit();

?>