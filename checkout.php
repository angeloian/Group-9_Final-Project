<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $contact_number = isset($_POST['number']) ? intval($_POST['number']) : '';
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $note = mysqli_real_escape_string($conn, $_POST['note']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, ''. $_POST['flat'].' '. $_POST['street'].' Brgy.'.$_POST['barangay'].' '. $_POST['city'].' - '. $_POST['region'].' zip:'.$_POST['zip']);
    
    $placed_on = date('d-M-Y');
    $time = date('H:i:s');
    $delivery_date = mysqli_real_escape_string($conn, $_POST['delivery_date']);
    $delivery_time = mysqli_real_escape_string($conn, $_POST['delivery_time']);
    $tracking_number = 'GMYPH'.date('YmdHis') . $user_id;

    $order_type = isset($_POST['order_type']) ? htmlspecialchars($_POST['order_type']) : '';
    $payment_status = 'Paid-Prepairing Order';

    $cart_total = 0;
    $cart_products[] = '';
  
    $select_shipping_rate_query = "SELECT shipping_rate FROM payee";
    $result = mysqli_query($conn, $select_shipping_rate_query);
    if($result) {
      // Fetch the shipping rate from the result set
      $row = mysqli_fetch_assoc($result);
      $shipping_rate = $row['shipping_rate'];
    }else {
      // If the query fails, display an error message
      echo "Error fetching delivery charges: " . mysqli_error($conn);
    }

    $flat = $_POST['flat'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
    $region = $_POST['region']; 
    $zip = $_POST['zip'];

    switch($region){

        case "NCR":
            $delivery_charges = $shipping_rate*0;
            break;
        case "CAR":
        case "I":
        case "II":
        case "III":
        case "IV-A":
        case "IV-B":
        case "V":
            $delivery_charges = $shipping_rate*1;
            break;
        case "VI":
        case "VII":
        case "VIII":
            $delivery_charges = $shipping_rate*2;
            break;
        case "IX":
        case "X":
        case "XI":
        case "XII":
        case "XIII":
        case "BARMM":
            $delivery_charges = $shipping_rate*3;
            break;
    };

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $item_quantity = $cart_item['quantity'];
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $cart_total += $sub_total;
        }
    }

    if($delivery_date==='FLORESSETTE EXPRESS'){

        $additional_charges = 100.00;
    }else{$additional_charges = 0.00;}

    $total_products = implode(', ',$cart_products);
    $delivery_charges = $delivery_charges + $additional_charges;
    $grand_total = $cart_total + $delivery_charges;
    $order_query = mysqli_query($conn, "SELECT * FROM `online_payment` WHERE name = '$name' AND contact_number = '$contact_number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

    if($cart_total == 0){
        $message[] = 'your cart is empty!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'order placed already!';
    }else{
  
          //update stocks
        $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($cart_query) > 0){
          while ($cart_item = mysqli_fetch_assoc($cart_query)) {
              $item_name = $cart_item['name'];
              $item_quantity = $cart_item['quantity'];
          
              // Update the products table
              $stmt = mysqli_prepare($conn, "UPDATE products SET stock = stock - ?, sold = sold + ? WHERE name = ?");
              mysqli_stmt_bind_param($stmt, "iis", $item_quantity, $item_quantity, $item_name);
              mysqli_stmt_execute($stmt) or die('query failed');
          }
        }
  
          //insert into online_payment table
          mysqli_query($conn, "INSERT INTO `orders` (user_id, name, contact_number, email, method, address, total_products, total_price, note, delivery_charges, placed_on, time, tracking_number, order_type) VALUES('$user_id', '$name', '$contact_number', '$email', '$method', '$address', '$total_products', '$cart_total', '$note', '$delivery_charges', '$placed_on','$time','$tracking_number', '$order_type')") or die('query failed');
          //update users table with previous contacts
          mysqli_query($conn, "UPDATE users SET name = '$name', contact_number = '$contact_number', email = '$email', flat = '$flat', street = '$street', barangay = '$barangay', city = '$city', region = '$region', zip = '$zip' WHERE id = '$user_id' ") or die('query failed');
          //remove from cart
          mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
  
        $message[] = 'order placed successfully!';
    }
  }
  
  
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/new.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Cash On Delivery</h3>
</section>

<section class="display-order">
    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total += $total_price;
    ?>    
    <p> <?php echo $fetch_cart['name'] ?> <span> (<?php echo '₱'.$fetch_cart['price'].' * '.$fetch_cart['quantity']  ?>) </span> </p>
    <?php
        }
        }else{
            echo '<p class="empty">your cart is empty</p>';
        }
    ?>
    <div class="grand-total">Total Price : <span>₱<?php echo $grand_total; ?>.00</span></div>
</section>

<section class="checkout">

    <form action="" method="POST">

        <h3>Billing address</h3>

        <div class="flex">
            <div class="inputBox">
                <span>Name:</span>
                <input type="text" name="name" placeholder="Enter your name" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''); ?>" required>
            </div>
            
            <div class="inputBox">
                <span>Contact Number:</span>
                <input type="number" name="number" min="0" placeholder="+63XXXXXXXXXX" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_contact_number']) ? $_SESSION['user_contact_number'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>Email:</span>
                <input type="email" name="email" placeholder="e.g. @gmail.com" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_email']) ? $_SESSION['user_email'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>Payment Method:</span>
                <select name="method">
                    <option value="cash on delivery">Cash on Delivery</option>
                </select>
            </div>
            <div class="inputBox">
                <span>House/Block/Lot no. :</span>
                <input type="text" name="flat" placeholder="e.g. house no." value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_flat']) ? $_SESSION['user_flat'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>Street:</span>
                <input type="text" name="street" placeholder="e.g. street name" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_street']) ? $_SESSION['user_street'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>Barangay:</span>
                <input type="text" name="barangay" placeholder="e.g. Addition Hills" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_barangay']) ? $_SESSION['user_barangay'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>City/Municipality:</span>
                <input type="text" name="city" placeholder="e.g. Mandaluyong City" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_city']) ? $_SESSION['user_city'] : ''); ?>" required>
            </div>

            <?php
                $query = "SELECT shipping_rate FROM payee";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $shipping_rate = $row['shipping_rate'];

                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            ?>

<div class="inputBox">
                <span>Region:</span>
                <select name="region">
                    <option value="NCR">Region NCR (Free Shipping)</option>
                    <option value="CAR">Region CAR &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*1; ?></option>
                    <option value="I">Region I &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*1; ?></option>
                    <option value="II">Region II &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*1; ?></option>
                    <option value="III">Region III &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*1; ?></option>
                    <option value="IV-A">Region IV-A &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*1; ?></option>
                    <option value="IV-B">Region IV-B &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*1; ?></option>
                    <option value="V">Region V &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*1; ?></option>
                    <option value="VI">Region VI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*2; ?></option>
                    <option value="VII">Region VII &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*2; ?></option>
                    <option value="VII">Region VIII &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*2; ?></option>
                    <option value="IX">Region IX &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*3; ?></option>
                    <option value="X">Region X &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*3; ?></option>
                    <option value="XI">Region XI &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*3; ?></option>
                    <option value="XII">Region XII &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*3; ?></option>
                    <option value="XIII">Region XIII &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $shipping_rate*3; ?></option>
                    <option value="BARMM">Region BARMM &nbsp;&nbsp;<?php echo $shipping_rate*3; ?></option>
                </select>
             </div>

            <div class="inputBox">
                <span>Zip Code:</span>
                <input type="number" min="0" name="zip" placeholder="e.g. 1550" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_zip']) ? $_SESSION['user_zip'] : ''); ?>" required>
            </div>

            <div class="inputBox">
                <span>Message/Note: </span>
                <input type="text" name="note" placeholder="255 Character Limit - Dear Ms. Juana, Happy Birthday ...">
            </div>

            <input type="hidden" name="order_type" value="fixed-COD">
        </div>

        <a class="btn" style="text-align: center;" href="payment_method.php">return</a>
        <input type="submit" name="order" value="checkout" class="btn">

    </form>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>