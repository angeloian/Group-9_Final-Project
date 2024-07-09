<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];



if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_payee'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact_number = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $shipping_rate = mysqli_real_escape_string($conn, $_POST['shipping_rate']);
    $date = date('Y-m-d H:i:s');
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folter = 'uploaded_img/'.$image;
 

       $insert_payee = mysqli_query($conn, "INSERT INTO `payee`(name, contact_number, qr_code,shipping_rate, date) VALUES('$name', '$contact_number', '$image','$shipping_rate', '$date')") or die('query failed');
 
       if($insert_payee){
          if($image_size > 2000000){
             $message[] = 'image size is too large!';
          }else{
             move_uploaded_file($image_tmp_name, $image_folter);
             $message[] = 'New Payee Added Successfully!';
             header("Location: ".$_SERVER['PHP_SELF']);
          }
       }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_new.css">

</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="add-products">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>New Transaction Information</h3>
      <input type="text" class="box" required placeholder="Name" name="name">
      <input type="number" min="09000000000" class="box" required placeholder="Contact No.: 09*********" name="contact_number">
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      <input type="number" class="box" required placeholder="Shipping Rate" name="shipping_rate">
      <input type="submit" value="add information" name="add_payee" class="btn">
   </form>

</section>

<section class="show-products">

   <div style="width: 100rem;" class="box-container">

      <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `payee` ORDER BY payee_id DESC LIMIT 1") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
      <h2 style="font-size: xx-large; color: #0e0041;">Latest Transaction Information</h2>
          <div class="name"><b>NAME: <br></b><?php echo $fetch_products['name']; ?></div>
         <div class="name"><b>CONTACT NO.: <br></b><?php echo $fetch_products['contact_number']; ?></div>
         <div class="name"><b>SHIPPING RATE:  </b>₱ <?php echo $fetch_products['shipping_rate']; ?></div>
         <img class="image" style="height: 25rem;" src="uploaded_img/<?php echo $fetch_products['qr_code']?>" alt="">
         <div class="name"><b>DATE-TIME CHANGED: </b><?php echo $fetch_products['date']; ?></div>
      </div>
      <?php
         }
      }
      ?>
   </div>
   
   <script src="js/admin_script.js"></script>

</section>