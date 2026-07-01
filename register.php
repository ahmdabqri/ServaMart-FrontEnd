<?php

include ('config.php');

if(isset($_POST['registerBtn'])){

    $name = $_POST['username'];
    $email = trim($_POST['email']); 
    $password = $_POST['password'];

    // CHECK IF EMAIL IS A VALID UTeM STUDENT EMAIL
    $allowedDomain = "@student.utem.edu.my";
    
    // CHECK IF EMAIL ENDS WITH THE ALLOWED DOMAIN (CASE-INSENSITIVE)
    if (substr(strtolower($email), -strlen($allowedDomain)) !== $allowedDomain) {
        echo "
        <script>
            alert('Registration failed: You must use a valid UTeM student email.');
            window.history.back();
        </script>
        ";
        exit(); 
    }

    // CHECK IF EMAIL ALREADY EXISTS IN THE DATABASE
    $checkEmail = mysqli_query(
        $conn,
        "SELECT * FROM userr 
        WHERE email='$email'"
    );

    if(mysqli_num_rows($checkEmail) > 0){
        echo "
        <script>
            alert('Email already exists');
        </script>
        ";
    }
    else{
        // HASH THE PASSWORD BEFORE STORING
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO userr (name,email,password,role) VALUES ('$name','$email','$hashedPassword','user')";

        if(mysqli_query($conn,$sql)){
            echo "
            <script>
                alert('Registration Successful');
                window.location.href='login.php';
            </script>
            ";
        }
        else{
            die(mysqli_error($conn));
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="register.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>

    <div></div>
    
    <div class="login-container">

        <div class="login-banner">

            <div class="banner-content">
                <h1>Welcome to <br> UTeM ServaMart</h1>
                <p>Buy,Sell,Service in one place</p>
            </div>
        </div>

       <div class="login-form-section">

    <h1 class="logo">
        UTeM <br> ServaMart
    </h1>

    <h2>Create Account</h2>

    <form class="login-form" id="register-formValidation" action="register.php" method="POST" novalidate>

        <div class="form-group">
            <label for="userName">User Name</label>
            <input type="text" name="username" id="userName" placeholder="Your User Name">
            <small id="userNameError" class="error"></small>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Your Email">
            <small id="emailError" class="error"></small>
        </div>

        <div class="form-group">
            <label for="password">Password</label>

                <div class="password-wrapper">
            <input type="password" name="password" id="password" placeholder="Your Password">
            <img src="image/eye-slash-svgrepo-com.svg"
                       class="togglePassword"
                      alt="Show Password">
                </div>

            <small id="passwordError" class="error"></small>
        </div>

        <div class="form-group">
            <label for="confirmPassword">Confirm Password</label>
            <div class="password-wrapper">
            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Re-Enter Your Password">
            <img src="image/eye-slash-svgrepo-com.svg"
                       class="togglePassword"
                      alt="Show Password">
                      </div>
            <small id="confirmPasswordError" class="error"></small>
        </div>

        <button type="submit" name="registerBtn" class="btn-primary">Sign Up</button>

    </form>
</div>

<script src="registerValidation.js"></script>
</body>
</html>