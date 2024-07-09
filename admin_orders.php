<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_order'])){
   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_id'") or die('query failed');
   $message[] = 'payment status has been updated!';
}

if(isset($_POST['update_online'])){
   $online_payment_id = $_POST['online_payment_id'];
   $update_payment = $_POST['update_payment'];
   mysqli_query($conn, "UPDATE `online_payment` SET payment_status = '$update_payment' WHERE id = '$online_payment_id'") or die('query failed');
   $message[] = 'Online order payment status has been updated!';
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_orders.php');
}

if(isset($_GET['delete_online'])){
   $delete_online_id = $_GET['delete_online'];
   mysqli_query($conn, "DELETE FROM `online_payment` WHERE id = '$delete_online_id'") or die('query failed');
   header('location:admin_orders.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_new.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
      
      $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
      <h1>COD Orders!</h1>
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
                        <p>Payment Status : <span style="color:<?php if($fetch_orders['payment_status'] == 'Pending'){echo 'red'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
                        <form action="" method="post">
                                <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                                <select name="update_payment">
                                 <option value="Prepairing">Prepairing</option>
                                 <option value="On - Transit">On - Transit</option>
                                 <option value="Recieved Recipient">Recieved Recipient</option>
                                 <option value="Completed (Paid)">Completed (Paid)</option>
                                </select>
            <input type="submit" name="update_order" value="update" class="option-btn">
            <a href="admin_orders.php?delete=<?php echo $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      $select_online_paid_orders = mysqli_query($conn, "SELECT * FROM `online_payment`") or die('Query failed');
            if (mysqli_num_rows($select_online_paid_orders) > 0) {
                while ($fetch_online_paid_orders = mysqli_fetch_assoc($select_online_paid_orders)) {
                  $total_price_with_delivery = $fetch_online_paid_orders['total_price'] + $fetch_online_paid_orders['delivery_charges'];
            ?>
                    <div class="box">
                    <h1>Paid Orders!</h1>
                        <h4>Account Details</h4>
                        <p>Recipient Name: <span><?php echo $fetch_online_paid_orders['name']; ?></span></p>
                        <p>Contact Number: <span><?php echo $fetch_online_paid_orders['contact_number']; ?></span></p>
                        <p>Email: <span><?php echo $fetch_online_paid_orders['email']; ?></span></p>
                        <p>Payment Method: <span><?php echo $fetch_online_paid_orders['method']; ?></span></p>
                        <p>Address: <span><?php echo $fetch_online_paid_orders['address']; ?></span></p>
                        <p>Product List: <span><?php echo $fetch_online_paid_orders['total_products']; ?></span></p>
                        <p>Total Product Price: <span>₱<?php echo $fetch_online_paid_orders['total_price']; ?>.00</span></p>
                        <p>Note: <span><?php echo $fetch_online_paid_orders['note']; ?></span></p>
                        <p>Shipping Fee: <span>₱<?php echo $fetch_online_paid_orders['delivery_charges']; ?>.00</span></p>
                        <p>Placed on: <span><?php echo $fetch_online_paid_orders['placed_on']; ?></span></p>
                        
                        <?php $total_price_with_delivery = $fetch_online_paid_orders['delivery_charges'] + $fetch_online_paid_orders['total_price']; ?>
                        
                        <p>Net Total (to be paid): <span>₱<?php echo $total_price_with_delivery; ?>.00</span></p>
                        <p>Tracking Number: <span><?php echo $fetch_online_paid_orders['tracking_number']; ?></span></p>
                        <p>Expected Date of Arrival: <span><?php echo $fetch_online_paid_orders['delivery_date']; ?></span></p>
                        <p>Gcash Ref No.: <span><?php echo $fetch_online_paid_orders['reference_number']; ?></span></p>
                        <p>Payment Status : <span style="color:<?php if($fetch_online_paid_orders['payment_status'] == 'Pending'){echo 'red'; }else{echo 'green';} ?>"><?php echo $fetch_online_paid_orders['payment_status']; ?></span> </p>
                        <form action="" method="post">
                           <input type="hidden" name="online_payment_id" value="<?php echo $fetch_online_paid_orders['id']; ?>">
                              <select name="update_payment">
                                 <option value="Prepairing">Prepairing</option>
                                 <option value="On - Transit">On - Transit</option>
                                 <option value="Recieved Recipient">Recieved Recipient</option>
                                 <option value="Completed (Paid)">Completed (Paid)</option>
                              </select>
                           <input type="submit" name="update_online" value="Update" class="option-btn">
                           <a href="admin_orders.php?delete_online=<?php echo $fetch_online_paid_orders['id']; ?>" class="delete-btn" onclick="return confirm('Delete this order?');">Delete</a>
               </form>

                        
         </div>
      <?php
            }
            } else {
                echo '<p class="empty">No Online orders placed yet!</p>';
            }
            ?>

        </div>
</section>













<script src="js/admin_script.js"></script>

</body>
</html>