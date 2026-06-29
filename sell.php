<?php

session_start();
include 'config.php';
include "navbarNotification.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user_id = $_SESSION['user_id'];

    $result = mysqli_query($conn,"
SELECT bank_account,payment_qr
FROM userr
WHERE user_id='$user_id'
");

$user = mysqli_fetch_assoc($result);

if(empty($user['bank_account']) || empty($user['payment_qr']))
{
    header("Location: paymentRequired.php");
    exit();
}

    $name = $_POST['itemName'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $condition = $_POST['condition'] ?? '';

    $itemType = $_POST['itemType'];

    $imageName = $_FILES['image']['name'];

    $tempName = $_FILES['image']['tmp_name'];

    move_uploaded_file($tempName,"uploads/" . $imageName);

   if($itemType == "product"){

    $condition = $_POST['condition'];





    $sql = "
INSERT INTO preloved_product
(
    user_id,
    name,
    description,
    price,
    category,
    `condition`,
    image
)
VALUES
(
    '$user_id',
    '$name',
    '$description',
    '$price',
    '$category',
    '$condition',
    '$imageName'
)
";

}

else{

    $location = $_POST['location'];
    $availability = $_POST['availability'];

    $sql = "
    INSERT INTO service_product
    (
        user_id,
        name,
        description,
        price,
        category,
        location,
        availability,
        image
    )
    VALUES
    (
        '$user_id',
        '$name',
        '$description',
        '$price',
        '$category',
        '$location',
        '$availability',
        '$imageName'
    )
    ";

}

if(mysqli_query($conn,$sql)){

    echo "
    <script>
        alert('Item Posted Successfully');
        window.location.href='homepage.php';
    </script>
    ";

}
else{

    die(mysqli_error($conn));

}

}


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
    <link rel="stylesheet" href="sell.css">
    

    <title>Sell Page ServaMart</title>
</head>

<header>
<nav class = "navbar">
    <div class = "logo">ServaMart</div>

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

    <form action="sell.php" method="POST" enctype="multipart/form-data">

    <input type="hidden"
       name="itemType"
       id="itemType"
       value="product">

    <div class="sell-form">

    <h1>Item Details</h1>

    <div class="form-group">
        <label>Type</label>

        <div class="type-buttons">

            <button type="button" id="productBtn" class="active">
                Product
            </button>

            <button type="button" id="serviceBtn">
                Service
            </button>

        </div>

    </div>

    <div class="form-group">
        <label>Item Name</label>

        <input type="text" id="itemName" name="itemName" placeholder="Enter item name">
        <small id="itemNameError" class="error"></small>
    </div>

    <div class="form-group">
        <label>Photos</label>

        <div class="photo-upload">

            <label class="photo-box">
                <input type="file" name="image" class="imageUpload" accept="image/*" hidden required>
                <img class="previewImage" src="">
                <span class="uploadText">+</span>
            </label>

        </div>
    </div>

    <div class="form-group">
        <label>Category</label>

        <select id="category" name="category">

            <option value="">Select Category</option>

            <option>Electronics</option>
            <option>Sports</option>
            <option>Books</option>
            <option>Fashion</option>
            <option>LifeStyle</option>

        </select>
        <small id="categoryError" class="error"></small>

    </div>

    <div id="conditionSection">

        <label>Condition</label>

        <div class="condition-buttons">

            <label>
                <input type="radio"
                    name="condition"
                    value="New">
                New
            </label>

            <label>
                <input type="radio"
                    name="condition"
                    value="Used">
                Used
            </label>

            <small id="conditionError" class="error"></small>

        </div>

    </div>

    <div id="serviceFields" style="display:none;">

        <div class="form-group">

            <label>Location</label>

            <input type="text" id="location" name="location" placeholder="Service Location">

            <small id="locationError" class="error"></small>

        </div>

        <div class="form-group">

            <label>Availability</label>

<select 
id="availability"
name="availability">

<option value="">
Select Availability
</option>

<option>
Everyday
</option>

<option>
Weekdays
</option>

<option>
Weekend
</option>

<option>
Monday - Friday
</option>

</select>

        </div>

    </div>

    <div class="form-group">

        <label>Description</label>

        <textarea
            id="description"
            name="description"
            rows="5"
            placeholder="Describe your item">
        </textarea>
        <small id="descriptionError" class="error"></small>

    </div>

    <div class="form-group">

        <label>Price (RM)</label>

        <input type="number" id="price" name="price" placeholder="0.00">
        <small id="priceError" class="error"></small>

    </div>

    <button class="post-btn" type="submit" name="postBtn">
        Post Item
    </button>

</div>
</form>

<script src="sell.js"></script>
   
</body>

<footer class="footer">
    <div class="footer-left">
        <p>&#169 2026 UTeM ServaMart </p>
    </div>
    <div class="footer-right">
        <a href="#">Help Centre</a>
        <span>|</span>
        <a href="#">Contact Us</a>
    </div>
    
</footer>
</html>