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
    <h3>about us</h3>
</section>

<section class="about" id="about">

    <h1 class="about-main"> WHY CHOOSE US?</h1>

    <div class="row">

        <div class="image-about">
            <img src="images/freshflowers.jpg" alt="">
        </div>

        <div class="about-content">
            <h3>Native and Local Artistrist</h3>
            <p>Gamay showcases the beauty of Filipino craftsmanship. Gamay collection features handmade treasures like stunning jewelry, unique home decorations, intricate textiles, souvenirs, and beautifully crafted wood carvings. Each item tells a story of filipino rich cultural heritage, blending tradition with modern design. Explore Gamay selection and find a special piece of Filipino artistry to bring warmth and style to your home.</p>
            <div class="icons-container">
                <div class="icon">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Faster and Free Delivery</span>
                </div>
                <div class="icon">
                    <i class="fas fa-peso-sign"></i>
                    <span>Budget Saver</span>
                </div>
            </div>
        </div>
    </div>
    

</section>

<section class="about" id="about">

    <h1 class="about-main">WHERE ARE WE LOCATED?</h1>

    <div class="row">

        <div class="image-about">
            <img src="images/pin3.png" alt="">
        </div>

        <div class="about-content">
            <h3>Discover Floral Magic the Beauty Blossoms in Taguig</h3>
            <p>Come visit Gamay in Taguig, where Gamay highlights Filipino craftsmanship with unique handcrafted items. You can find Gamay in the heart of Taguig, a place that blends traditional art with modern style. Explore Gamay collection of beautiful jewelry, home decor, textiles, and woodworks—all handmade with skill and care, reflecting our Filipino heritage. We invite you to experience the warmth and artistry of Gamay right here in Taguig</p>
            <div class="icons-container">
                <div class="icon">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Fast Delivery</span>
                </div>
                <div class="icon">
                    <i class="fas fa-peso-sign"></i>
                    <span>Budget Saver</span>
                </div>
            </div>
        </div>
    </div>
    

</section>

<section class="about" id="about">

    <h1 class="about-main">How we started</h1>

    <div class="row">

        <div class="image-about">
            <img src="images/starts2.jpg" alt="">
        </div>

        <div class="about-content">
            <h3>Da Gamay Journey</h3>
            <p>Gamay began with a deep appreciation for Filipino craftsmanship and culture. Founded on the idea of showcasing the beauty of local artistry, it started small with a passion for handmade treasures. Over time, Gamay has evolved into a destination where customers can discover exquisite jewelry, unique home decor items, intricate textiles, and finely crafted woodworks—all meticulously created by Filipino artisans. Embracing the essence of heritage and creativity, Gamay continues to celebrate and share the rich traditions of Filipino craftsmanship with the world</p>
            <div class="icons-container">
                <div class="icon">
                    <i class="fas fa-shipping-fast"></i>
                    <span>Faster and Free Delivery</span>
                </div>
                <div class="icon">
                    <i class="fas fa-peso-sign"></i>
                    <span>Budget Saver</span>
                </div>
            </div>
        </div>
    </div>
    

</section>






<?php @include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>