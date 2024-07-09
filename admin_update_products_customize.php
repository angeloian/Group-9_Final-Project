<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $stock = mysqli_real_escape_string($conn, $_POST['stock']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);

   mysqli_query($conn, "UPDATE `customize` SET name = '$name',stock = '$stock' , price = '$price' WHERE id = '$update_p_id'") or die('query failed');

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;
   $old_image = $_POST['update_p_image'];
   
   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image file size is too large!';
      }else{
         mysqli_query($conn, "UPDATE `customize` SET image = '$image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($image_tmp_name, $image_folter);
         unlink('uploaded_img/'.$old_image);
         $message[] = 'image updated successfully!';
      }
   }

   $message[] = 'product updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/admin_new.css">

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="update-product">

<?php

   $update_id = $_GET['update'];
   $select_customize = mysqli_query($conn, "SELECT * FROM `customize` WHERE id = '$update_id'") or die('query failed');
   if(mysqli_num_rows($select_customize) > 0){
      while($fetch_customize = mysqli_fetch_assoc($select_customize)){
?>

<form action="" method="post" enctype="multipart/form-data">
   <img src="uploaded_img/<?php echo $fetch_customize['image']; ?>" class="image"  alt="">
   <input type="hidden" value="<?php echo $fetch_customize['id']; ?>" name="update_p_id">
   <input type="hidden" value="<?php echo $fetch_pcustomizets['image']; ?>" name="update_p_image">
   <input type="text" class="box" value="<?php echo $fetch_customize['name']; ?>" required placeholder="update product name" name="name">
   <input type="number" class="box" value="<?php echo $fetch_customize['stock']; ?>" required placeholder="update product stock" name="stock">
   <input type="number" min="1" class="box" value="<?php echo $fetch_customize['price']; ?>" required placeholder="update product price" name="price">
   <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
   <input type="submit" value="update product" name="update_product" class="btn">
   <a href="admin_products_customize.php" class="option-btn">go back</a>
</form>

<?php
      }
   }else{
      echo '<p class="empty">no update product select</p>';
   }
?>

</section>













<script src="js/admin_script.js"></script>

</body>
</html>