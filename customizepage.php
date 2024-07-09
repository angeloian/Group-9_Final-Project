<?php
@include 'config.php';

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/new.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>

<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Customizing your Flower</h3>
</section>

<section class="home-slide" id="home-slide">

   <div class="swiper mySwiper container-slide">

      <div class="swiper-wrapper wrapper-slide">

         <div class="swiper-slide slide">
            <div class="all-content">
               <span>Radiant Romance Bouquet</span>
               <h3></h3>
               <p>Experience floral perfection with our bespoke arrangements featuring sunflowers in vibrant hues, symbolizing love, joy, and elegance. Elevate any occasion with our stunning creations.</p>
               <a href="payment_methodcustomize.php" class="slide-btn">Customize now!</a>
            </div>
            <div class="picture-slide">
               <img src="images/sunflower.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="all-content">
               <span>Springtime Splendor Arrangement</span>
               <h3></h3>
               <p>Indulge in nature's beauty with our exquisite blend of roses, tulips, and sunflowers, crafted to captivate hearts and evoke a sense of admiration and delight.</p>
               <a href="payment_methodcustomize.php" class="slide-btn">Customize now!</a>
            </div>
            <div class="picture-slide">
               <img src="images/rosetulip.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="all-content">
               <span>Golden Harvest Centerpiece</span>
               <h3></h3>
               <p>Enrich your surroundings with our delightful fusion of roses, tulips, and sunflowers, harmonizing colors and textures for a visually stunning centerpiece.</p>
               <a href="payment_methodcustomize.php" class="slide-btn">Customize now!</a>
            </div>
            <div class="picture-slide">
               <img src="images/rose sunflower.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="all-content">
               <span>Serenity Garden Bouquet</span>
               <h3></h3>
               <p>Embrace the charm of nature with our enchanting mix of roses, tulips, and sunflowers, each bloom meticulously selected to create a mesmerizing symphony of colors.</p>
               <a href="payment_methodcustomize.php" class="slide-btn">Customize now!</a>
            </div>
            <div class="picture-slide">
               <img src="images/sunflowertulip.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="all-content">
               <span>Joyful Summer Bouquet</span>
               <h3></h3>
               <p>Celebrate life's special moments with our enchanting assortment of roses designed to add a touch of elegance and sophistication to any setting.</p>
               <a href="payment_methodcustomize.php" class="slide-btn">Customize now!</a>
            </div>
            <div class="picture-slide">
               <img src="images/rose.png" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="all-content">
               <span>Eternal Sunshine Bouquet</span>
               <h3></h3>
               <p>Immerse yourself in the beauty of our bespoke arrangements, featuring tulips curated to convey warmth, joy, and everlasting happiness in every petal.</p>
               <a href="payment_methodcustomize.php" class="slide-btn">Customize now!</a>
            </div>
            <div class="picture-slide">
               <img src="images/tulip.png" alt="">
            </div>
         </div>
      </div>

      <div class="swiper-pagination"></div>
   </div>

</section>


<?php @include 'footer.php'; ?>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>


</body>
</html>