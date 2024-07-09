<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};
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

<section class="dashboard">

   <h1 class="title">ADMIN dashboard</h1>

   <div class="box-container">

      <div class="box">
         <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>Order list</p>
      </div>

      <div class="box">
         <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>Total Product added</p>
      </div>

      <div class="box">
         <?php
            $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type = 'user'") or die('query failed');
            $number_of_users = mysqli_num_rows($select_users);
         ?>
         <h3><?php echo $number_of_users; ?></h3>
         <p>Active Users</p>
      </div>

      <div class="box">
         <?php
            $select_account = mysqli_query($conn, "SELECT * FROM `users`") or die('query failed');
            $number_of_account = mysqli_num_rows($select_account);
         ?>
         <h3><?php echo $number_of_account; ?></h3>
         <p>Number of Registered Users</p>
      </div>

      <div class="box">
         <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM `message`") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>Messages</p>
      </div>
      
      <div class="box">
         <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM products ORDER BY sold DESC LIMIT 1") or die('query failed');
            if(mysqli_num_rows($select_messages) > 0){
            $best_buy = mysqli_fetch_assoc($select_messages);
         }
         ?>
         <img class="image" style="height: 20rem;" src="uploaded_img/<?php echo $best_buy['image']; ?>" alt="">
        <h3 style="font-size: medium;"><?php echo $best_buy['name']; ?></h3>
        <p>Most Sold Item</p>
      </div>
      
      <div class="box">
         <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM products ORDER BY sold ASC LIMIT 1") or die('query failed');
            if(mysqli_num_rows($select_messages) > 0){
            $least_bought = mysqli_fetch_assoc($select_messages);
         }
         ?>
         <img class="image" style="height: 20rem;" src="uploaded_img/<?php echo $least_bought['image']; ?>" alt="">
        <h3 style="font-size: medium;"><?php echo $least_bought['name']; ?></h3>
        <p>Least Sold Item</p>
      </div>


   </div>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>