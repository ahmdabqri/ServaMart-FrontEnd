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

$userSearch = $_GET['user_search'] ?? '';

$userQuery = mysqli_query(
    $conn,
    "SELECT *
     FROM userr
     WHERE name LIKE '%$userSearch%'
     OR email LIKE '%$userSearch%'
     ORDER BY user_id DESC"
);

$productSearch = $_GET['product_search'] ?? '';

$productQuery = mysqli_query(
    $conn,
    "SELECT
        preloved_product.*,
        userr.name AS seller_name
     FROM preloved_product
     INNER JOIN userr
     ON preloved_product.user_id = userr.user_id
     WHERE preloved_product.name
     LIKE '%$productSearch%'
     ORDER BY preloved_product.preloved_id DESC"
);

$serviceSearch = $_GET['service_search'] ?? '';

$serviceQuery = mysqli_query(
    $conn,
    "SELECT
        service_product.*,
        userr.name AS provider_name
     FROM service_product
     INNER JOIN userr
     ON service_product.user_id = userr.user_id
     WHERE service_product.name
     LIKE '%$serviceSearch%'
     ORDER BY service_product.service_id DESC"
);

$totalUsers = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM userr")
);

$totalProducts = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM preloved_product")
);

$totalServices = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM service_product")
);

$totalOrders = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM order_table")
);

$totalBookings = mysqli_num_rows(
    mysqli_query($conn,"SELECT * FROM booking_order")
);

$totalRevenueQuery = mysqli_query(
    $conn,
    "SELECT SUM(total_amount) AS revenue
     FROM order_table
     WHERE payment_status = 'Completed'"
);

$totalRevenue = mysqli_fetch_assoc(
    $totalRevenueQuery
);

$pendingPayments = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT *
         FROM order_table
         WHERE payment_status =
         'Pending Verification'"
    )
);

$completedOrders = mysqli_num_rows(
    mysqli_query(
        $conn,
        "SELECT *
         FROM order_table
         WHERE payment_status='Completed'"
    )
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

    <form method="GET">

    <input
        type="text"
        name="user_search"
        placeholder="Search User"
        value="<?php echo $userSearch; ?>">

</form>

    <table class="admin-table">

        <tr>
            <th>Full Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
while($user = mysqli_fetch_assoc($userQuery)){
?>
<tr>

    <td>
        <?php echo $user['name']; ?>
    </td>

    <td>
        <?php echo $user['email']; ?>
    </td>

    <td>

        <span class="status active-status">

            <?php echo ucfirst($user['role']); ?>

        </span>

    </td>

    <td>

        <?php
        if($user['role'] != 'admin'){
        ?>

        <a href="deleteUser.php?id=<?php echo $user['user_id']; ?>">

            <button class="delete-btn">

                Delete

            </button>

        </a>

        <?php
        }
        ?>

    </td>

</tr>

<?php
}
?>

    </table>

</div>

<div id="productContent"
     class="admin-content">

    <h3>Manage Product</h3>

<form method="GET">

    <input
        type="text"
        name="product_search"
        placeholder="Search Product"
        value="<?php echo $productSearch; ?>">

</form>

    <table class="admin-table">

        <tr>
            <th>Product ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Seller</th>
            <th>Action</th>
        </tr>

        <?php while($product = mysqli_fetch_assoc($productQuery)){ ?>

        <tr>

            <td>
                <?php echo $product['preloved_id']; ?>
            </td>

            <td>
                <?php echo $product['name']; ?>
            </td>

            <td>
                RM <?php echo number_format($product['price'],2); ?>
            </td>

            <td>
                <?php echo $product['seller_name']; ?>
            </td>

            <td>

                <a
                href="deleteProduct.php?id=<?php echo $product['preloved_id']; ?>"
                onclick="return confirm('Delete this product?')">

                    <button class="delete-btn">
                        Delete
                    </button>

                </a>

            </td>

        </tr>

        <?php
        }
        ?>

    </table>

</div>

<div id="serviceContent"
     class="admin-content">

    <h3>Manage Services</h3>

    <form method="GET">

    <input
        type="text"
        name="service_search"
        placeholder="Search Service"
        value="<?php echo $serviceSearch; ?>">

</form>

    <table class="admin-table">

        <tr>
            <th>Service ID</th>
            <th>Service Name</th>
            <th>Provider</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php
while($service = mysqli_fetch_assoc($serviceQuery)){
?>

<tr>

    <td>
        <?php echo $service['service_id']; ?>
    </td>

    <td>
        <?php echo $service['name']; ?>
    </td>

    <td>
        <?php echo $service['provider_name']; ?>
    </td>

    <td>
        RM <?php echo number_format($service['price'],2); ?>
    </td>

    <td>
        <?php echo $service['status']; ?>
    </td>

    <td>

        <a
        href="deleteService.php?id=<?php echo $service['service_id']; ?>"
        onclick="return confirm('Delete this service?')">

            <button class="delete-btn">
                Delete
            </button>

        </a>

    </td>

</tr>

<?php
}
?>

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

            <p><?php echo $totalUsers; ?></p>

        </div>

        <div class="report-card">

            <h4>Total Products</h4>

            <p><?php echo $totalProducts; ?></p>

        </div>

        <div class="report-card">

            <h4>Total Services</h4>

            <p><?php echo $totalServices; ?></p>

        </div>

        <div class="report-card">

            <h4>Total Orders</h4>

            <p><?php echo $totalOrders; ?></p>

        </div>

        <div class="report-card">

            <h4>Total Bookings</h4>

            <p><?php echo $totalBookings; ?></p>

        </div>

        <div class="report-card">

        <h4>Pending Payments</h4>

        <p>
            <?php echo $pendingPayments; ?>
        </p>

        </div>

        <div class="report-card">

    <h4>Completed Orders</h4>

    <p>
        <?php echo $completedOrders; ?>
    </p>

</div>

        <div class="report-card">

            <h4>Total Revenue</h4>

            <p>RM <?php echo number_format($totalRevenue['revenue'] ?? 0,2); ?></p>

        </div>

    </div>

</div>
<script src="adminDashboard.js"></script>
</body>
</html>