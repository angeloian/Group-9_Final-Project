<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="css/new.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Choose Type of payment</h3>
</section>

<section>

<div class="container">
        <div class="title">
            <h4>Select a <span>Payment</span> method</h4>
        </div>

        <form action="#">
            <input type="radio" name="payment" id="cod">
            <input type="radio" name="payment" id="onlinepayment">


            <div class="category">
                <label for="cod" class="visaMethod">
                    <div class="imgName">
                        <div class="imgContainer visa">
                            <img src="images/cod.png" alt="">
                        </div>
                        <span class="name">Cash on Delivery</span>
                    </div>
                    <span class="check"><i class="fa-solid fa-circle-check" style="color: #FF10F0;"></i></span>
                </label>

                <label for="onlinepayment" class="mastercardMethod">
                    <div class="imgName">
                        <div class="imgContainer mastercard">
                            <img src="images/olpay.png" alt="">
                        </div>
                        <span class="name">Online Payment</span>
                    </div>
                    <span class="check"><i class="fa-solid fa-circle-check" style="color: #FF10F0;"></i></span>
                </label>

            </div>
            <a class="btn" style="text-align: center; width:100%" href="customizepage.php">Return to your cart</a>
        </form>
    </div>
</section>


<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
