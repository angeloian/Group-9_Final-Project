<?php

@include 'config.php';

session_start();



if(isset($_POST['submit'])){

      $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $email = mysqli_real_escape_string($conn, $filter_email);
      $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
      $pass = mysqli_real_escape_string($conn, md5($filter_pass));

      $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'rider'){

         $_SESSION['name'] = $row['name'];
         $_SESSION['email'] = $row['email'];
         $_SESSION['id'] = $row['id'];
         header('location:deliver.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];


         $_SESSION['user_contact_number'] = $row['contact_number'];
         $_SESSION['user_flat'] = $row['flat'];
         $_SESSION['user_street'] = $row['street'];
         $_SESSION['user_barangay'] = $row['barangay'];
         $_SESSION['user_city'] = $row['city'];
         $_SESSION['user_region'] = $row['region'];
         $_SESSION['user_zip'] = $row['zip'];
         header('location:home.php');

      }else{
         $message[] = 'No existing user found!';
      }

   }else{
      $message[] = 'Incorrect email or password!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/new.css">
   <script src="https://kit.fontawesome.com/731bf1111b.js" crossorigin="anonymous"></script>
   <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:wght@300;500;600;800;900&family=Open+Sans:wght@300&family=Poppins&display=swap" rel="stylesheet">

</head>
<body>

<?php
      if(isset($message)){
         foreach($message as $message){
            echo '
            <div class="message">
               <span>'.$message.'</span>
               <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
            </div>
            ';
         }
      }
      ?>

   
<section class="form-container">

   <form action="" method="post">
      <h3>Login To <span>GAMAY</span></h3>
      <div class="input-group">
         <div class="input-field">
            <i class="fa-solid fa-envelope"></i>
            <input type="email" name="email" placeholder="Enter your email" required>
         </div>

         <div class="input-field">
            <i class="fa-solid fa-lock"></i>
            <input type="password" name="pass" placeholder="Enter your password" required>
         </div>
      </div>
      <p>Not yet Registered? <a href="register.php">register now</a></p>
      <input type="submit" class="btn" name="submit" value="login">

   </form>

</section>



</body>
</html>