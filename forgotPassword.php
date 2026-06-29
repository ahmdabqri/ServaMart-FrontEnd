<?php

include('config.php');

$step = 'checkEmail'; 
$formMessage = "";
$formMessageIsError = true;
$emailValue = "";

// USER SUBMITTED EMAIL TO CHECK
if (isset($_POST['forgotBtn'])) {

    $email = trim($_POST['email']);
    $emailValue = $email;

    $stmt = mysqli_prepare($conn, "SELECT user_id FROM userr WHERE email = ?");
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        // Email found - show password fields
        $step = 'resetPassword';
        $formMessage = "Email found. Enter your new password below.";
        $formMessageIsError = false;
    } else {
        $step = 'checkEmail';
        $formMessage = "No account found with this email.";
    }

}

// USER KEY IN NEW PASSWORDS TO RESET   
if (isset($_POST['resetBtn'])) {

    $email = trim($_POST['email']);
    $emailValue = $email;
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password === '' || $confirmPassword === '') {

        $step = 'resetPassword';
        $formMessage = "Please fill in both password fields.";

    } else if ($password !== $confirmPassword) {

        $step = 'resetPassword';
        $formMessage = "Passwords do not match.";

    } else if (strlen($password) < 8) {

        $step = 'resetPassword';
        $formMessage = "Password must be at least 8 characters.";

    } else {

        // COMFIRMING EMAIL STILL EXISTS BEFORE UPDATING PASSWORD
        $check = mysqli_prepare($conn, "SELECT user_id FROM userr WHERE email = ?");
        mysqli_stmt_bind_param($check, "s", $email);
        mysqli_stmt_execute($check);
        $checkResult = mysqli_stmt_get_result($check);

        if (mysqli_num_rows($checkResult) === 0) {

            $step = 'checkEmail';
            $formMessage = "Email not found. Please try again.";

        } else {

            // HASH THE NEW PASSWORD BEFORE STORING
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            $update = mysqli_prepare($conn, "UPDATE userr SET password = ? WHERE email = ?");
            mysqli_stmt_bind_param($update, "ss", $hashedPassword, $email);

            if (mysqli_stmt_execute($update)) {

                echo "
                <script>
                    alert('Your password has been reset successfully. Please log in.');
                    window.location.href='login.php';
                </script>
                ";
                exit;

            } else {
                $step = 'resetPassword';
                $formMessage = "Something went wrong. Please try again.";
            }

        }

    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="forgotPassword.css">
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

            <?php if ($step === 'checkEmail'): ?>
                <p class="form-subtext">Enter your email to get started.</p>
            <?php else: ?>
                <p class="form-subtext">Enter your new password below.</p>
            <?php endif; ?>

            <?php if ($formMessage): ?>
                <p class="error" style="display:block; margin-bottom:15px; <?php echo $formMessageIsError ? '' : 'color:green;'; ?>">
                    <?php echo htmlspecialchars($formMessage); ?>
                </p>
            <?php endif; ?>

            <?php if ($step === 'checkEmail'): ?>

                <form class="login-form" id="forgot-formValidation" action="forgotPassword.php" method="POST">

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" placeholder="Your Email" value="<?php echo htmlspecialchars($emailValue); ?>">
                        <small id="emailError" class="error"></small>
                    </div>

                    <button type="submit" name="forgotBtn" class="btn-primary">Check Email</button>

                    <p class="form-footer-link">
                        <a href="login.php">Back to Login</a>
                    </p>

                </form>

            <?php else: ?>

                <form class="login-form" id="reset-formValidation" action="forgotPassword.php" method="POST">

                    <input type="hidden" name="email" value="<?php echo htmlspecialchars($emailValue); ?>">

                    <div class="form-group">
                        <label for="password">New Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="password" id="password" placeholder="Your New Password">
                            <img src="image/eye-slash-svgrepo-com.svg" class="togglePassword" alt="Show Password">
                        </div>
                        <small id="passwordError" class="error"></small>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm New Password</label>
                        <div class="password-wrapper">
                            <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Re-Enter Your New Password">
                            <img src="image/eye-slash-svgrepo-com.svg" class="togglePassword" alt="Show Password">
                        </div>
                        <small id="confirmPasswordError" class="error"></small>
                    </div>

                    <button type="submit" name="resetBtn" class="btn-primary">Reset Password</button>

                    <p class="form-footer-link">
                        <a href="login.php">Back to Login</a>
                    </p>

                </form>

            <?php endif; ?>

        </div>

    </div>

    <script src="forgotPasswordValidation.js"></script>
</body>
</html>