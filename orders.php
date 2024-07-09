<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/new.css">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;500;600;800;900&family=Open+Sans:wght@300&family=Poppins&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Yanone+Kaffeesatz:wght@700&display=swap" rel="stylesheet">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>orders</h3>
</section>

<section class="placed-orders">

    <h1 class="title">Your Placed Order</h1>

    <div class="box-container">

    <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('Query failed');
            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
                    $total_price_with_delivery = $fetch_orders['total_price'] + $fetch_orders['delivery_charges'];
            ?>
                    <div class="box">
                        <h1>Paid Orders!</h1>
                        <h4>Account Details</h4>
                        <p>Recipient Name: <span><?php echo $fetch_orders['name']; ?></span></p>
                        <p>Contact Number: <span><?php echo $fetch_orders['contact_number']; ?></span></p>
                        <p>Email: <span><?php echo $fetch_orders['email']; ?></span></p>
                        <p>Payment Method: <span><?php echo $fetch_orders['method']; ?></span></p>
                        <p>Address: <span><?php echo $fetch_orders['address']; ?></span></p>
                        <p>Product List: <span><?php echo $fetch_orders['total_products']; ?></span></p>
                        <p>Total Product Price: <span>₱<?php echo $fetch_orders['total_price']; ?>.00</span></p>
                        <p>Note: <span><?php echo $fetch_orders['note']; ?></span></p>
                        <p>Shipping Fee: <span>₱<?php echo $fetch_orders['delivery_charges']; ?>.00</span></p>
                        <p>Placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                        
                        <?php $total_price_with_delivery = $fetch_orders['delivery_charges'] + $fetch_orders['total_price']; ?>
                        
                        <p>Net Total (to be paid): <span>₱<?php echo $total_price_with_delivery; ?>.00</span></p>
                        <p>Tracking Number: <span><?php echo $fetch_orders['tracking_number']; ?></span></p>
                        <p>Expected Date of Arrival: <span><?php echo $fetch_orders['delivery_date']; ?></span></p>
                        <p>Estimated Time of Arrival: <span><?php echo $fetch_orders['delivery_time']; ?></span></p>
                        <p>Payment Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'Pending'){echo 'red'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
                    </div>
            <?php
                }
            } else {
                echo '<p class="empty">No regular orders placed yet!</p>';
            }
            ?>

        </div>

</section>







<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>