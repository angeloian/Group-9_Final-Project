<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $stock = mysqli_real_escape_string($conn, $_POST['stock']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already exist!';
   }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, stock , details, price, image) VALUES('$name', '$stock', '$details', '$price', '$image')") or die('query failed');

      if($insert_product){
         if($image_size > 2000000){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folter);
            $message[] = 'product added successfully!';
         }
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   header('location:admin_products.php');

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
      <h3>New Products</h3>
      <input type="text" class="box" required placeholder="Product Name" name="name">
      <input type="number" class="box" required placeholder="Number of Stocks" name="stock">
      <input type="number" min="1" class="box" required placeholder="Product Price" name="price">
      <textarea name="details" class="box" required placeholder="Product Details" cols="30" rows="10"></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      <input type="submit" value="add product" name="add_product" class="btn">

   </form>

</section>

<section class="show-products" style="display: flex; justify-content: center; text-align: center;">
   <div>
      <h3 class="name" style="font-size: xx-large;">Product Arrangement</h3>
      <button id="sortByStock" class="btn" style="margin: 1rem;">By number of Stock</button>
      <button id="sortBySold" class="btn" style="margin: 1rem;">By number of sold</button>
   </div>
</section>

<script>
    document.getElementById('sortByStock').addEventListener('click', function() {
        // Reload the page with a query parameter indicating the sorting choice
        window.location.href = 'admin_products.php?sortBy=stock';
    });

    document.getElementById('sortBySold').addEventListener('click', function() {
        // Reload the page with a query parameter indicating the sorting choice
        window.location.href = 'admin_products.php?sortBy=sold';
    });
</script>


<section class="show-products">

      <div class="box-container">

      <?php

         $sortBy = isset($_GET['sortBy']) ? $_GET['sortBy'] : 'stock'; // Default to sorting by stock


         $orderByClause = '';
         if ($sortBy === 'stock') {
            $orderByClause = 'ORDER BY stock ASC';
         } elseif ($sortBy === 'sold') {
            $orderByClause = 'ORDER BY sold DESC'; 
         }

         $select_products = mysqli_query($conn, "SELECT * FROM `products` $orderByClause") or die('query failed');

         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
               // Determine the CSS class based on stock quantity
               $stock = $fetch_products['stock'];
               if ($stock == 0) {
                  $border_color = '#d3d3d3';
               }elseif ($stock <= 25) {
                  $border_color = '#fa9d98';
               } elseif ($stock <= 50) {
                  $border_color = '#fafaa7';
               } else {
                  $border_color = ''; // No special styling if stock is greater than 50
               }

               $sold = $fetch_products['sold'];
      ?>
      <div class="box" style="background-color: <?php echo $border_color; ?>">
         <div class="price">₱<?php echo $fetch_products['price']; ?>.00</div>
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         <div class="details"><?php echo $fetch_products['details']; ?></div>
         <div class="name" style="font-size: medium;"><b>Quantity: </b><?php echo $stock; ?> pcs in stock</div>
         <div class="name" style="font-size: medium;"><b>No. of Items Sold: </b><?php echo $sold; ?> sold items</div>
         <a href="admin_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
   

</section>












<script src="js/admin_script.js"></script>

</body>
</html>