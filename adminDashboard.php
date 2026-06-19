<?php

//protect supaya user takboleh masuk admin guna url
session_start();

if($_SESSION['role'] != 'admin'){

    header("Location: login.php");
    exit();

}

include 'config.php';

$paymentQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM order_table
     WHERE payment_status = 'Pending Verification'
     ORDER BY order_date DESC"
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
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="theme.css">
    <link rel="stylesheet" href="adminDashboard.css">

    

    <title>Admin Dashboard ServaMart</title>
</head>
<body>
    <section class="admin-container">

    <div class="admin-card">

        <h2>Admin Dashboard</h2>

        <div class="admin-tabs">

            <button id="userTab" class="admin-btn active">
                Manage User
            </button>

            <button id="productTab" class="admin-btn">
                Manage Product
            </button>

            <button id="serviceTab" class="admin-btn">
                Manage Services
            </button>

            <button id="bookingTab" class="admin-btn">
                Manage Booking
            </button>

            <button id="paymentTab" class="admin-btn">
                Manage Payments
            </button>

            <button id="reportTab" class="admin-btn">
                Reports
            </button>

        </div>

        <div id="userContent"
     class="admin-content active-content">

    <input type="text"
           placeholder="Search User">

    <table class="admin-table">

        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <tr>
            <td>Ahmad Abqari</td>
            <td>d032410278@student.utem.edu.my</td>
            <td>
                <span class="status active-status">
                    Active
                </span>
            </td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

    </table>

</div>

<div id="productContent"
     class="admin-content">

    <h3>Manage Product</h3>

    <input type="text"
           placeholder="Search Product">

    <table class="admin-table">

        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Seller</th>
            <th>Action</th>
        </tr>

        <tr>
            <td>P001</td>
            <td>Desporte Futsal Shoes</td>
            <td>RM300</td>
            <td>Ahmad</td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

        <tr>
            <td>P002</td>
            <td>Gaming Mouse</td>
            <td>RM50</td>
            <td>Ali</td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

    </table>

</div>

<div id="serviceContent"
     class="admin-content">

    <h3>Manage Services</h3>

    <input type="text"
           placeholder="Search Service">

    <table class="admin-table">

        <tr>
            <th>Service ID</th>
            <th>Service Name</th>
            <th>Provider</th>
            <th>Price</th>
            <th>Action</th>
        </tr>

        <tr>
            <td>S001</td>
            <td>Laundry Service</td>
            <td>Ahmad</td>
            <td>RM15</td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

        <tr>
            <td>S002</td>
            <td>Laptop Repair</td>
            <td>Ali</td>
            <td>RM50</td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

        <tr>
            <td>S003</td>
            <td>DSA Tutoring</td>
            <td>Wan</td>
            <td>RM25</td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

    </table>

</div>

<div id="bookingContent"
     class="admin-content">

    <h3>Manage Booking</h3>

    <input type="text"
           placeholder="Search Booking">

    <table class="admin-table">

        <tr>
            <th>Booking ID</th>
            <th>Customer</th>
            <th>Service</th>
            <th>Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <tr>
            <td>B001</td>
            <td>Ahmad</td>
            <td>Laundry Service</td>
            <td>20 June 2026</td>
            <td>
                <span class="booking-status confirmed">
                    Confirmed
                </span>
            </td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

        <tr>
            <td>B002</td>
            <td>Ali</td>
            <td>Laptop Repair</td>
            <td>22 June 2026</td>
            <td>
                <span class="booking-status pending">
                    Pending
                </span>
            </td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

        <tr>
            <td>B003</td>
            <td>Siti</td>
            <td>DSA Tutoring</td>
            <td>25 June 2026</td>
            <td>
                <span class="booking-status completed">
                    Completed
                </span>
            </td>
            <td>
                <button class="delete-btn">
                    Delete
                </button>
            </td>
        </tr>

    </table>

</div>

<div id="paymentContent" class="admin-content">

    <h3>Manage Payments</h3>

    <input type="text" placeholder="Search Payment">

    <table class="admin-table">

<tr>
    <th>Order ID</th>
    <th>Customer</th>
    <th>Amount</th>
    <th>Proof</th>
    <th>Status</th>
    <th>Action</th>
</tr>

<?php
while($payment = mysqli_fetch_assoc($paymentQuery)){
?>

<tr>

    <td>
        #<?php echo $payment['order_id']; ?>
    </td>

    <td>
        <?php echo $payment['full_name']; ?>
    </td>

    <td>
        RM <?php echo number_format($payment['total_amount'],2); ?>
    </td>

    <td>

        <a
        href="uploads/payment/<?php echo $payment['payment_proof']; ?>"
        target="_blank">

        View Receipt

        </a>

    </td>

    <td>
        <?php echo $payment['payment_status']; ?>
    </td>

    <td>

    <a href="approvePayment.php?id=<?php echo $payment['order_id']; ?>" class="approve-link">

        <button class="approve-btn">
            Approve
        </button>

    </a>

    <a href="rejectPayment.php?id=<?php echo $payment['order_id']; ?>" class="reject-link">

        <button class="reject-btn">
            Reject
        </button>

    </a>

</td>

</tr>

<?php
}
?>

</table>

</div>

<div id="reportContent"
     class="admin-content">

    <h3>Reports</h3>

    <div class="report-grid">

        <div class="report-card">

            <h4>Total Users</h4>

            <p>120</p>

        </div>

        <div class="report-card">

            <h4>Total Products</h4>

            <p>85</p>

        </div>

        <div class="report-card">

            <h4>Total Services</h4>

            <p>42</p>

        </div>

        <div class="report-card">

            <h4>Total Orders</h4>

            <p>67</p>

        </div>

        <div class="report-card">

            <h4>Total Bookings</h4>

            <p>31</p>

        </div>

        <div class="report-card">

            <h4>Total Revenue</h4>

            <p>RM 5,250</p>

        </div>

    </div>

</div>
<script src="adminDashboard.js"></script>
</body>
</html>