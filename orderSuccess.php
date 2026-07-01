<?php

session_start();
include 'config.php';

$order_id = $_GET['order_id'];

$query = mysqli_query(
    $conn,
    "SELECT *
     FROM order_table
     WHERE order_id = '$order_id'"
);

$order = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="OrderSuccess.css">
</head>

<body>

    <section class="success-container">

        <div class="success-card">

            <div class="success-icon">
                ✓
            </div>

            <h1>Order Placed Successfully!</h1>

            <p>
                Thank you for using ServaMart.
                Your order has been received and is being processed.
            </p>

                <div class="order-info">

                    <p>
                        <strong>Order ID:</strong>
                        #<?php echo $order['order_id']; ?>
                    </p>

                    <p>
                        <strong>Total:</strong>
                        RM <?php echo number_format($order['total_amount'],2); ?>
                    </p>

                    <p>
                        Your payment proof has been submitted.
                        Waiting for admin verification.
                    </p>

                </div>

            <div class="success-buttons">

                <a href="homepage.php" class="home-btn">
                    Back To Home
                </a>

                <a href="userProfile.php" class="order-btn">
                    View Purchases
                </a>

            </div>

        </div>

    </section>

</body>
</html>