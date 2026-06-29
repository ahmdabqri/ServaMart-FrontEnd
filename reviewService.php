<?php

session_start();
include 'config.php';

$service_id = $_GET['service_id'];
$booking_id = $_GET['booking_id'];

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
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="reviewService.css">
    
    <title>Reiview Service</title>
</head>
<body>

    <div class="review-container">

    <h2>Leave a Review</h2>

    <form action="submitReview.php" method="POST">

        <input type="hidden" name="service_id" value="<?php echo $service_id; ?>">

        <input type="hidden" name="booking_id" value="<?php echo $booking_id; ?>">


<div class="form-group">

<label>Rating</label>

<select name="rating" required>

<option value="">
Select Rating
</option>

<option value="1">⭐ 1 Star</option>
<option value="2">⭐⭐ 2 Stars</option>
<option value="3">⭐⭐⭐ 3 Stars</option>
<option value="4">⭐⭐⭐⭐ 4 Stars</option>
<option value="5">⭐⭐⭐⭐⭐ 5 Stars</option>

</select>

</div>

<div class="form-group">

<label>Comment</label>

<textarea
name="comment"
placeholder="Share your experience..."
required>
</textarea>

</div>

<button
type="submit"
class="submit-review-btn">

Submit Review

</button>

</form>

</div>
    
</body>
</html>

