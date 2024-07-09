<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];


if(!isset($user_id)){
   header('location:login.php');
}
if(isset($_POST['online_payment'])){

    $rose_value = isset($_POST['rose']) ? $_POST['rose'] : 0;
    $tulip_value = isset($_POST['tulip']) ? $_POST['tulip'] : 0;
    $sunflower_value = isset($_POST['sunflower']) ? $_POST['sunflower'] : 0;
    $custom_note = isset($_POST['custom_note']) ? $_POST['custom_note'] : '';
    $note = isset($_POST['note']) ? $_POST['note'] : '';
    $order_type = isset($_POST['order_type']) ? htmlspecialchars($_POST['order_type']) : '';
    $payment_type = isset($_POST['payment_type']) ? htmlspecialchars($_POST['payment_type']) : '';
    $selected_region = isset($_POST['country']) ? $_POST['country'] : '';
    $delivery_charges = ($selected_region != 'NCR') ? 100 : 0; 


    if ($rose_value == 0 && $tulip_value == 0 && $sunflower_value == 0) {


        echo '<p class="empty">Please choose at least one product!</p>';
        
    } else {
      if($selected_region != 'NCR'){
        $delivery_charges = 100;
    }
    
    
        $total_products = 'Rose = '.$rose_value.' pc/s, Tulip = '.$tulip_value.' pc/s, Sunflower = '.$sunflower_value.' pc/s,';
        $total_price = $rose_value * 100 + $tulip_value * 500 + $sunflower_value * 150 + $delivery_charges;
        $cart_total = $total_price;
    
    }

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $number = isset($_POST['number']) ? intval($_POST['number']) : '';
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $method = mysqli_real_escape_string($conn, $_POST['method']);
  $address = mysqli_real_escape_string($conn, $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
  $placed_on = date('d-M-Y');
  $tracking_number = 'FLRSSTPH'.date('YmdHis') . $user_id;
  $account_name = mysqli_real_escape_string($conn, $_POST['account_name']);
  $account_number = isset($_POST['account_number']) ? intval($_POST['account_number']) : '';
  $ccv_number = isset($_POST['ccv_number']) ? intval($_POST['ccv_number']) : '';
  $card_type = mysqli_real_escape_string($conn, $_POST['card_type']);
  $cart_total = 0;
  $cart_products[] = '';


      $placed_on_date = new DateTime($placed_on);
      $first_additional_date = clone $placed_on_date;

      $first_additional_date->modify('+3 day'); 

      $first_additional_date_formatted = $first_additional_date->format('d-M-Y');

      $estimated_arrival_time = "$first_additional_date_formatted";

      if($total_price != 0){
        mysqli_query($conn, "INSERT INTO `online_payment` (user_id, name, number, email, method, address, total_products, total_price, custom_note, placed_on, estimated_arrival_time, tracking_number, account_name, account_number, ccv_number, card_type, delivery_charges, order_type) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price','$custom_note', '$placed_on','$estimated_arrival_time','$tracking_number','$account_name','$account_number','$ccv_number','$card_type','$delivery_charges','$order_type')") or die('query failed');
      $message[] = 'order placed successfully!';
      }

  }



?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Online Payment</title>
  <link rel="stylesheet" href="css/new.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Online Payment Method</h3>
</section>


<section class="checkout">

    <form action="" method="POST">

        <div>
            <h3>Customize your Flower</h3>
            <h2>Please indicate how many respective flower you want to include in the bouquet!</h2>    
        </div>

        <div class="flex">

            <div class="inputBox">
                <div>
                    <img src="https://images.squarespace-cdn.com/content/v1/616616774daea671d4b9fee0/1639517337069-QNW3ROJQUF56TSHL4Y76/FREEDOM-700X700-768x768.jpg?format=1000w" height="60%" width="30%" alt="Rose Web Picture"/>
                </div>
                <span>Rose/s:</span>
                <select name="rose">
                    <option value="0">none</option>
                    <option value="1">₱100 = 1 pc of Rose</option>
                    <option value="2">₱200 = 2 pcs of Roses</option>
                    <option value="3">₱300 = 3 pcs of Roses</option>
                    <option value="4">₱400 = 4 pcs of Roses</option>
                    <option value="5">₱500 = 5 pcs of Roses</option>
                    <option value="6">₱600 = 6 pcs of Roses</option>
                    <option value="7">₱700 = 7 pcs of Roses</option>
                    <option value="8">₱800 = 8 pcs of Roses</option>
                    <option value="9">₱900 = 9 pcs of Roses</option>
                    <option value="10">₱1000 = 10 pcs of Roses</option>
                </select>
            </div>

            <div class="inputBox">
                <div>                    
                    <img src="https://ludaflower.com/wp-content/uploads/2018/06/PT1-600x600.jpg" height="60%" width="30%" alt="Rose Web Picture"/>
                </div>
                <span>Tulip/s:</span>
                <select name="tulip">
                    <option value="0">none</option>
                    <option value="1">₱500 = 1 pc of Tulip</option>
                    <option value="2">₱1000 = 2 pcs of Tulips</option>
                    <option value="3">₱1500 = 3 pcs of Tulips</option>
                    <option value="4">₱2000 = 4 pcs of Tulips</option>
                    <option value="5">₱2500 = 5 pcs of Tulips</option>
                    <option value="6">₱3000 = 6 pcs of Tulips</option>
                    <option value="7">₱3500 = 7 pcs of Tulips</option>
                    <option value="8">₱4000 = 8 pcs of Tulips</option>
                    <option value="9">₱4500 = 9 pcs of Tulips</option>
                    <option value="10">₱5000 = 10 pcs of Tulips</option>
                </select>
            </div>

            <div class="inputBox">
                <div>                    
                    <img src="https://www.craftoutlet.com/media/catalog/product/cache/1/image/1000x1000/9df78eab33525d08d6e5fb8d27136e95/i/m/image_35372.jpg" height="30%" width="15%" alt="Rose Web Picture"/>
                </div>
                <span>Sunflower/s:</span>
                <select name="sunflower">
                    <option value="0">none</option>
                    <option value="1">₱150 = 1 pc of Sunflower</option>
                    <option value="2">₱300 = 2 pcs of Sunflowers</option>
                    <option value="3">₱450 = 3 pcs of Sunflowers</option>
                    <option value="4">₱600 = 4 pcs of Sunflowers</option>
                    <option value="5">₱750 = 5 pcs of Sunflowers</option>
                    <option value="6">₱900 = 6 pcs of Sunflowers</option>
                    <option value="7">₱1050 = 7 pcs of Sunflowers</option>
                    <option value="8">₱1200 = 8 pcs of Sunflowers</option>
                    <option value="9">₱1350 = 9 pcs of Sunflowers</option>
                    <option value="10">₱1500 = 10 pcs of Sunflowers</option>
                </select>

                <div class="inputBox">
                    <span>Message/Note: </span>
                    <input type="text" name="custom_note" placeholder="Limit 100 character - indicate color for rose and tulips..." required>
                </div>

            </div>


        </div>

        <h3>Account Information</h3>

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
            <option value="online payment">Online Payment</option>
        </select>
    </div>
    <div class="inputBox">
        <span>Date of Delivery:</span>
        <select name="delivery_date">
            <option value="FLORESSETTE EXPRESS">FLORESSETTE EXPRESS (+ ₱100)</option>
            <option value="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"><?php echo date('F j, Y', strtotime('+1 day')); ?></option>
            <option value="<?php echo date('Y-m-d', strtotime('+2 days')); ?>"><?php echo date('F j, Y', strtotime('+2 days')); ?></option>
            <option value="<?php echo date('Y-m-d', strtotime('+3 days')); ?>"><?php echo date('F j, Y', strtotime('+3 days')); ?></option>
        </select>
    </div>
    <div class="inputBox">
        <span>Time of Delivery:</span>
        <select name="delivery_time">
            <option value=" 9:00 AM - 11:00 AM"> 9:00 AM - 11:00 AM</option>
            <option value=" 2:00 PM -  5:00 PM"> 2:00 PM -  5:00 PM</option>
            <option value=" 7:00 PM -  9:00 PM"> 7:00 PM -  9:00 PM</option>
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
        <span>Reference Number:</span>
        <input type="text" name="reference_number" placeholder="Reference Number here 1234567890000" required>
    </div>

    <div class="inputBox">
        <span>Message/Note: </span>
        <input type="text" name="note" placeholder="255 Character Limit - Dear Ms. Juana, Happy Birthday ...">
    </div>
    
    <div class="inputBox">

        <?php
            $select_payee = mysqli_query($conn, "SELECT * FROM `payee` ORDER BY payee_id DESC LIMIT 1") or die('Query failed');
            $fetch_payee = mysqli_fetch_assoc($select_payee);
        ?>
        <?php if ($fetch_payee) : ?>
            <span><b>Acct. Name: </b><?php echo $fetch_payee['name']; ?></span> <br>
            <span><b>Contact Number: </b><?php echo $fetch_payee['contact_number']; ?></span> <br>
            <img class="image" style="height: 35rem;" src="uploaded_img/<?php echo $fetch_payee['qr_code']; ?>" alt="">
        <?php endif; ?>


    </div>

</div>
<input type="hidden" name="order_type" value="fixed-ONLINE">
</div>

<a class="btn" style="text-align: center;" href="payment_method.php">return</a>
<input type="submit" name="online_payment" value="Checkout" class="btn">
</form>

</section>


<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>
</body>
</html>