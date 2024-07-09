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

<header class="header">

    <div class="flex">

        <a href="home.php" class="logo">
            <img src="images/logo3.jpg">
        </a>


        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <a href="search_page.php" class="fas fa-search"></a>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>



        <div class="account-box">
            <?php
                session_start();
                if ($_SESSION['user_type'] === 'guest') {
                    // If user is a guest, display the additional div with login and register links
                    echo '<a href="logout.php" class="delete-btn">logout</a>';
                    // Hide the paragraphs for the guest
                    echo '<p style="display:none;">username : <span>' . $_SESSION['user_name'] . '</span></p>';
                    echo '<p style="display:none;">email : <span>' . $_SESSION['user_email'] . '</span></p>';
                } else {
                    // If user is not a guest, display the username, email, and logout link
                    echo '<p>username : <span>' . $_SESSION['user_name'] . '</span></p>';
                    echo '<p>email : <span>' . $_SESSION['user_email'] . '</span></p>';
                    echo '<a href="logout.php" class="delete-btn">logout</a>';
                }
            ?>
        </div>

    </div>

</header>