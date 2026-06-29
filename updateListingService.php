<?php

session_start();

include 'config.php';

$user_id = $_SESSION['user_id'];

$service_id = $_POST['service_id'];

$name = $_POST['name'];

$price = $_POST['price'];

$location = $_POST['location'];

$description = $_POST['description'];

/* Ambil gambar lama */

$imageQuery = mysqli_query(

$conn,

"SELECT image

FROM service_product

WHERE service_id = '$service_id'

AND user_id = '$user_id'"

);

$service = mysqli_fetch_assoc($imageQuery);

$imageName = $service['image'];

/* Kalau upload gambar baru */

if($_FILES['image']['name'] != ""){

    $imageName = time()."_".$_FILES['image']['name'];

    if(

        move_uploaded_file(

            $_FILES['image']['tmp_name'],

            "uploads/".$imageName

        )

    ){

        if(

        $service['image'] != "" &&

        file_exists("uploads/".$service['image'])

        ){

            unlink("uploads/".$service['image']);

        }

    }

}

/* Update database */

mysqli_query(

$conn,

"UPDATE service_product

SET

name = '$name',

price = '$price',

location = '$location',

description = '$description',

image = '$imageName'

WHERE service_id = '$service_id'

AND user_id = '$user_id'"

);

/* Balik profile */

header("Location:userProfile.php");

exit();

?>