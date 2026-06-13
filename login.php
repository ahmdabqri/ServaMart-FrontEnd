<?php

$email = $_POST["email"];
$password = $_POST["password"];

if($email == "d032410278@student.utem.edu.my" && $password == "12345678")
{
    header("Location: homepage.html");
    exit();
}
else
{
    echo "
    <script>
        alert('Invalid Email or Password');
        window.location.href='login.html';
    </script>
    ";
}

?>

