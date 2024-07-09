<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if($user_id == 19){

    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    mysqli_query($conn, "DELETE FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');

}

session_unset();
session_destroy();

header('location:index.php');

?>