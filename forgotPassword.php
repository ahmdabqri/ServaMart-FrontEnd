<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
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

            <h2>Forgot Password</h2>
            <p class="form-subtext">Enter your email and we'll send you a link to reset your password.</p>

            <form class="login-form" id="forgot-formValidation" action="forgot-password.php" method="POST">

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="Your Email">
                    <small id="emailError" class="error"></small>
                </div>

                <button type="submit" name="forgotBtn" class="btn-primary">Send Reset Link</button>

                <p class="form-footer-link">
                    <a href="login.php">Back to Login</a>
                </p>

            </form>
        </div>

    </div>

    <script src="forgotPasswordValidation.js"></script>
</body>
</html>