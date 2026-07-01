<?php

session_start();
include 'config.php';

$user_id = $_SESSION['user_id'];

if(
    !isset($_FILES['paymentProof']) ||
    $_FILES['paymentProof']['error'] != 0
){

    echo "
    <script>

    alert('Please upload your proof of payment.');

    window.history.back();

    </script>
    ";

    exit();

}

$paymentProof =
$_FILES['paymentProof']['name'];

$tempProof =
$_FILES['paymentProof']['tmp_name'];

move_uploaded_file(
    $tempProof,
    "uploads/payment/" . $paymentProof
);

$fullName = $_POST['fullName'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$postcode = $_POST['postcode'];

$paymentProof =
$_FILES['paymentProof']['name'];

$tempProof =
$_FILES['paymentProof']['tmp_name'];

move_uploaded_file(
    $tempProof,
    "uploads/payment/" . $paymentProof
);

if(!isset($_POST['selected_items'])){
    die("No item selected");
}

$selectedItems = $_POST['selected_items'];

$ids = implode(",", $selectedItems);

$total = 0;

$cartQuery = mysqli_query(
    $conn,
    "SELECT cart.*, preloved_product.price
     FROM cart
     JOIN preloved_product
     ON cart.preloved_id = preloved_product.preloved_id
     WHERE cart.cart_id IN ($ids)"
);

while($item = mysqli_fetch_assoc($cartQuery)){

    $total += $item['price'];

}

mysqli_query(
    $conn,
    "INSERT INTO order_table
(
    user_id,
    full_name,
    phone,
    email,
    address,
    city,
    state,
    postcode,
    total_amount,
    payment_proof,
    payment_status
)
    VALUES
    (
        '$user_id',
        '$fullName',
        '$phone',
        '$email',
        '$address',
        '$city',
        '$state',
        '$postcode',
        '$total',
        '$paymentProof',
        'Pending Verification'
    )"
);

$order_id = mysqli_insert_id($conn);

$cartQuery = mysqli_query(
    $conn,
    "SELECT cart.*, preloved_product.price
     FROM cart
     JOIN preloved_product
     ON cart.preloved_id = preloved_product.preloved_id
     WHERE cart.cart_id IN ($ids)"
);

while($item = mysqli_fetch_assoc($cartQuery)){

    mysqli_query(
        $conn,
        "INSERT INTO order_item
        (
            order_id,
            preloved_id,
            price
        )
        VALUES
        (
            '$order_id',
            '".$item['preloved_id']."',
            '".$item['price']."'
        )"
    );

}

mysqli_query(
    $conn,
    "DELETE FROM cart
     WHERE cart_id IN ($ids)"
);

header("Location: orderSuccess.php?order_id=$order_id");
exit();