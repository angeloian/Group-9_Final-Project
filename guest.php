<?php

@include 'config.php';

session_start();

$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE user_type ='guest'") or die('query failed');

$row = mysqli_fetch_assoc($select_users);

$_SESSION['user_name'] = $row['name'];
$_SESSION['user_email'] = $row['email'];
$_SESSION['user_id'] = $row['id'];
$_SESSION['user_type'] = $row['user_type'];
header('location:home.php');

$message[] = 'Welcome our Guest!'

?>