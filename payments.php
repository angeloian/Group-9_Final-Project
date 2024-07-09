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
   <title>Payments</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/new.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Payment</h3>
</section>

<section class="payment">
    <h4>Credit Cards (Master/Visa)</h4>
    <p>Gamay strives to make your shopping experience as seamless and convenient as possible. Gamay offer multiple payment options to cater to customer needs:
    <h4>Bank Deposit / Fund Transfer</h4>
    <p>Before we are able to process your order, kindly proceed with your fund transfer (via internet banking or ATM). You can also opt to do a bank deposit in any BDO or BPI branches.</p>
    <p>Our bank accounts’ details are as follow:</p>
    <ul>
        <p>Account Name: <span>Florresset Inc.</span></p>
        <p> Savings Account: <span>000987654321</span></p>
        <p>BPI Current Account: <span>098654321</span></p>
    </ul>
    <p>To enable us to process your order promptly, please use the same bank’s fund transfer facility (BDO to BDO or BPI to BPI) which facilitates immediate payment.</p>
    <p>Kindly email the Transaction Reference No. to sales@knots.ph or send us a copy of your deposit slip (along with your Order Number) once you have completed the fund transfer.</p>
    <p>Upon the successful receipt of your payment, you will receive an acknowledgment email from us.</p>
    <h4>Remittance</h4>
    <p>We also allow payment through Palawan, MLhuiller, Westen Union and other remittance payments. Kindly contacts us to get the details for the remittance.</p>
    <p>For other payment concerns you may contact us at any of our available medium for communication.</p>
</section>


   <?php @include 'footer.php'; ?>

   </body>
</html>