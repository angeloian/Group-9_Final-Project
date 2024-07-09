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
   <title>about</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/new.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Policies</h3>
</section>

<section class="policies">

      <h4>Terms of Service</h4>
      <p>
      By using Gamay’s website and services, you agree to these terms. Product descriptions and images aim for accuracy but may vary slightly due to the handcrafted nature of  items. Prices are subject to change without notice, and Gamay reserves the right to cancel orders due to pricing errors. All content on Gamay website is Gamay's property and may not be used without permission.
      </p>

      <h4>Security & Privacy Policy</h4>
      <p>
         Gamay collects personal information like name, email, shipping address, and payment details to process orders and improve customer experience. Gamay implement security measures to protect this information and may share it with third-party providers for transaction purposes. By using Gamay services, you consent to this collection and use of information. Gamay security measures include encrypted transactions and secure data storage. Gamay pledge to handle customer information with the utmost care and will not sell or share customer data with unauthorized parties. Customer consent to Gamay policy is implied by customer use of Gamay services. We do not send unsolicited emails.
      </p>

      <h4>Shipping Policy</h4>
      <p>
         Orders in Metro Manila are processed within 1-3 business days, while nationwide orders take 5-7 business days. A tracking number is provided once the order ships.
      </p>

      <h4>Delivery Guarantee</h4>
      <p>
         Gamay guarantees delivery of customer orders within the estimated timeframe provided at checkout. In case of delays, Gamay will notify you promptly and provide updated delivery information.
      </p>

      <h4>Customer Service Policy</h4>
      <p>
         For inquiries or concerns, contact us via Gamay’s social media handles. Gamay team is available Monday to Friday, 8 AM to 58 PM (local time), and the team aims to respond within 2-3 business days. During holidays, responses may be delayed. Gamay are committed to customer satisfaction and will resolve any issues promptly.
      </p>

      <h4>Redirection of Delivery</h4>
      <p>
         If a customer needs to redirect delivery to a different address after the order has been placed, please contact us immediately. Gamay will do its best to accommodate customer requests but cannot guarantee changes once the order has been shipped.
      </p>

      <h4>Holiday Delivery</h4>
      <p>
         During holiday seasons, delivery times may be extended due to increased demand and carrier schedules. Gamay recommends placing orders early or after the holidays to ensure timely delivery.
      </p>

      <h4>Cancellation Of Order</h4>
      <p>
         Gamay strives to process and ship customer orders as quickly as possible. Therefore, once an order is placed, it cannot be canceled. Gamay encourages all customers to review their orders carefully before completing the purchase. As a responsible buyer, please ensure that you have selected the correct items and item quantity and provided accurate shipping information. If you have any questions or need assistance before placing your order, Gamay customer service team is here to help.
      </p>

      <h4>Our Refund & Return Policy</h4>
      <p>
         Returns are accepted within 30 days of purchase if items are in pristine condition, unscathed, deviated, and have the official receipt. You may contact customer service to initiate a return. Refunds are issued to the original payment method within 5-7 business days after inspecting the returned item.
      </p>

      <h4>Unsolicited Email</h4>
      <p>
         Gamay respects customer privacy and does not send unsolicited emails. Customers will only receive communications from Gamay if they have opted in to our mailing list or if it is necessary to complete a transaction.
      </p>

   </section>


   <?php @include 'footer.php'; ?>

   </body>
</html>