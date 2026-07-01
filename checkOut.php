<?php

session_start();
include 'config.php';
include "navbarNotification.php";

if(!isset($_POST['selected_items'])){

    echo "Please select at least one item";
    exit();

}

$total = 0;
$selectedItems = $_POST['selected_items'];

$ids = implode(",", $selectedItems);

$total = 0;

$query = mysqli_query(
    $conn,
    "SELECT cart.*,
       preloved_product.*,
       userr.bank_name,
       userr.bank_account,
       userr.payment_qr
    FROM cart
    JOIN preloved_product
    ON cart.preloved_id =
    preloved_product.preloved_id

    JOIN userr
    ON preloved_product.user_id =
    userr.user_id

    WHERE cart.cart_id IN ($ids)"
);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="navbar.css">
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="checkOut.css">
    

    <title>Checkout Page</title>
</head>

<header>
<nav class = "navbar">
    <div class = "logo">
        <a href="homepage.php">
            <img src="image/logo.png" alt="ServaMart Logo">
        </a>
    </div>

    <div class="search-container">
        <img src="image/search.svg.svg" alt="Search" class="search-icon">
        <input type="text" id="search-input" placeholder="Search">
    </div>

    <div class="nav-menu">
        <button class="sell-button">SELL</button>

 <a href="userProfile.php">

            <div class="profile-icon">

            <img src="image/profile-round-1342-svgrepo-com.svg">
        

            <?php
            if($totalNotification > 0){
            ?>

                <span class="profile-badge">
                    <?php echo $totalNotification; ?>
                </span>

            <?php
            }
            ?>

        </div>

        <span>Profile</span>

        </a>

        <a href="cart.php">
            <img src="image/cart-shopping-svgrepo-com.svg">
            <span>Cart</span>
        </a>

    </div>

</nav>
</header>
<body>

    <section class="checkout-container">

    <form action="place-order.php" method="POST" id="checkOut-formValidation" class="checkout-form" enctype="multipart/form-data">

        <h1>Checkout</h1>

        <h2>Customer Information</h2>

        <div class="form-group">

            <input type="text" id="fullName" name="fullName" placeholder="Full Name">

            <small id="fullNameError" class="error"></small>

        </div>

        <div class="form-group">

            <input type="text" id="phone" name="phone" placeholder="Phone Number">

            <small id="phoneError" class="error"></small>

        </div>

        <div class="form-group">

            <input type="email" id="email" name="email" placeholder="Email">

            <small id="emailError" class="error"></small>

        </div>
        
        <h2>Delivery Address</h2>

        <div class="form-group">

            <input type="text" id="address" name="address" placeholder="Address">

            <small id="addressError" class="error"></small>

        </div>
        
        <div class="form-group">

            <input type="text" id="city" name="city" placeholder="City">

            <small id="cityError" class="error"></small>

        </div>

        <div class="form-group">

            <input type="text" id="state" name="state" placeholder="State">

            <small id="stateError" class="error"></small>

        </div>

        <div class="form-group">

            <input type="text" id="postcode" name="postcode" placeholder="Postcode">

            <small id="postcodeError" class="error"></small>

        </div>

        

        <?php
            foreach($selectedItems as $cart_id){
            ?>

            <input
                type="hidden"
                name="selected_items[]"
                value="<?php echo $cart_id; ?>">

            <?php
            }
            ?>
            

  

    <div class="checkout-summary">

    <h2>Order Summary</h2>

    <?php 
    $sellerBank = "";
    $sellerAccount = "";
    $sellerQR = "";
    
    while($row = mysqli_fetch_assoc($query)){ 
        $sellerBank = $row['bank_name'];
        $sellerAccount = $row['bank_account'];
        $sellerQR = $row['payment_qr'];
        ?>

        <div class="summary-item">

            <span>
                <?php echo $row['name']; ?>
            </span>

            <span>
                RM <?php echo number_format($row['price'],2); ?>
            </span>

        </div>

        <?php
            $total += $row['price'];
        ?>

    <?php } ?>

    <hr>

    <div class="summary-total">

        <span>Total</span>

        <span>
            RM <?php echo number_format($total,2); ?>
        </span>

    </div>

    <hr>

    <h3>Transfer To Seller</h3>

    <p>
        <strong>Bank:</strong>
        <?php echo $sellerBank; ?>
    </p>

    <p>
        <strong>Account Number:</strong>
        <?php echo $sellerAccount; ?>
    </p>

    <?php
    if(!empty($sellerQR)){
    ?>

    <img
        src="uploads/payment/<?php echo $sellerQR; ?>"
        width="220">

    <?php
    }
    ?>

    <div class="form-group">

    <h3>Proof Of Payment</h3>

    <input
    type="file"
    id="paymentProof"
    name="paymentProof"
    accept="image/*">

<small id="paymentProofError" class="error"></small>

</div>

    <button
        type="submit"
        class="place-order-btn"
        form="checkOut-formValidation">

        Place Order

    </button>

</div>

</form>

</section>
  
<script src="checkOut.js"></script>
</body>

<footer class="footer">
    <div class="footer-left">
        <p>&#169 2026 UTeM ServaMart </p>
    </div>
</footer>
</html>