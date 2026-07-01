<?php

session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$name = $_POST['name'];
$email = $_POST['email'];

$imageName = $_FILES['profile_image']['name'];

$tmpName = $_FILES['profile_image']['tmp_name'];

move_uploaded_file(
    $tmpName,
    "uploads/".$imageName
);

mysqli_query(

$conn,

"UPDATE userr

SET

name = '$name',
email = '$email',
profile_image = '$imageName'

WHERE user_id = '$user_id'"

);

header("Location:userProfile.php");

?>