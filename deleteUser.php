<?php

include 'config.php';

$user_id = $_GET['id'];

mysqli_query(
    $conn,
    "DELETE FROM userr
     WHERE user_id = '$user_id'"
);

header("Location: adminDashboard.php");
exit();

?>