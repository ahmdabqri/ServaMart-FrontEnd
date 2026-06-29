<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Payment Information Required</title>
    <link rel="stylesheet" href="paymentRequired.css">
</head>
<body>

<div class="payment-required-card">

    <div class="icon">
        💳
    </div>

    <h2>Payment Information Required</h2>

    <p>
        Before you can sell a product or service,
        please complete your payment information first.
    </p>

    <a href="userProfile.php">
        <button class="payment-btn">
            Go To Payment Information
        </button>
    </a>

</div>

</body>
</html>