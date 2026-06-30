<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "servamart_db"
);

if(!$conn){
    die("Connection Failed: " . mysqli_connect_error());
}

?>