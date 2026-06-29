<?php

session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

$preloved_id = $_GET['id'];

$query = mysqli_query(

$conn,

"SELECT *

FROM preloved_product

WHERE preloved_id = '$preloved_id'

AND user_id = '$user_id'"

);

$product = mysqli_fetch_assoc($query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="editListingPreloved.css">
    <title>Edit My Listing</title>
</head>
<body>

<div class="edit-container">

    <div class="edit-card">

        <h2>Edit Listing</h2>

        <p class="subtitle">
            Update your listing information.
        </p>

        <form
        action="updateListingPreloved.php"
        method="POST"
        enctype="multipart/form-data">

            <input
            type="hidden"
            name="preloved_id"
            value="<?php echo $product['preloved_id']; ?>">

            <div class="image-preview">

                <img id="previewImage" src="uploads/<?php echo $product['image']; ?>">

            </div>

            <label>Change Image</label>

                <input type="file" name="image" id="imageInput" accept="image/*">

            <label>Product Name</label>

            <input
            type="text"
            name="name"
            value="<?php echo $product['name']; ?>">

            <label>Price (RM)</label>

            <input
            type="number"
            step="0.01"
            name="price"
            value="<?php echo $product['price']; ?>">

            <label>Description</label>

            <textarea
            name="description"><?php echo $product['description']; ?></textarea>

            <div class="button-group">

                <a href="userProfile.php"
                class="cancel-btn">

                Cancel

                </a>

                <button type="submit" class="save-btn">

                Update Listing

                </button>

            </div>

        </form>

    </div>

</div>

<script>

const imageInput =
document.getElementById("imageInput");

const previewImage =
document.getElementById("previewImage");

imageInput.addEventListener("change", function(){

    if(this.files && this.files[0]){

        const reader = new FileReader();

        reader.onload = function(e){

            previewImage.src = e.target.result;

        }

        reader.readAsDataURL(this.files[0]);

    }

});

</script>
    
</body>
</html>