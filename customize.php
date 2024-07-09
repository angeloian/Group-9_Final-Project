<?php
@include 'config.php';

session_start();

if (!isset($_SESSION['user_id'])) {
   header('Location: login.php');
}

$user_id = $_SESSION['user_id'];

$select_products = mysqli_query($conn, "SELECT * FROM `customize` WHERE name = 'rose' ") or die('query failed');
if(mysqli_num_rows($select_products) > 0){
    while($fetch_products = mysqli_fetch_assoc($select_products)){
        $rose_stock = $fetch_products['stock'];
        $rose_price = $fetch_products['price'];
    }}
$select_products = mysqli_query($conn, "SELECT * FROM `customize` WHERE name = 'tulip' ") or die('query failed');
if(mysqli_num_rows($select_products) > 0){
    while($fetch_products = mysqli_fetch_assoc($select_products)){
        $tulip_stock = $fetch_products['stock'];
        $tulip_price = $fetch_products['price'];
    }}
$select_products = mysqli_query($conn, "SELECT * FROM `customize` WHERE name = 'sunflower' ") or die('query failed');
if(mysqli_num_rows($select_products) > 0){
    while($fetch_products = mysqli_fetch_assoc($select_products)){
        $sunflower_stock = $fetch_products['stock'];
        $sunflower_price = $fetch_products['price'];
    }}

if (isset($_POST['customize'])) {





    $rose_value = isset($_POST['rose']) ? $_POST['rose'] : 0;
    $tulip_value = isset($_POST['tulip']) ? $_POST['tulip'] : 0;
    $sunflower_value = isset($_POST['sunflower']) ? $_POST['sunflower'] : 0;
    $custom_note = isset($_POST['custom_note']) ? $_POST['custom_note'] : '';
    $note = isset($_POST['note']) ? $_POST['note'] : '';
    $order_type = isset($_POST['order_type']) ? htmlspecialchars($_POST['order_type']) : '';
    $selected_region = isset($_POST['country']) ? $_POST['country'] : '';
    $delivery_charges = ($selected_region != 'NCR') ? 100 : 0; 

    if ($rose_value == 0 && $tulip_value == 0 && $sunflower_value == 0) {


        echo '<p class="empty">Please choose at least one product!</p>';
        
    } else {
        if($selected_region != 'NCR'){
          $delivery_charges = 100;
      } 
      
      
          $total_products = 'Rose = '.$rose_value.' pc/s, Tulip = '.$tulip_value.' pc/s, Sunflower = '.$sunflower_value.' pc/s,';
          $total_price = $rose_value * $rose_price + $tulip_value * $tulip_price + $sunflower_value * $sunflower_price + $delivery_charges;

      }

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = isset($_POST['number']) ? intval($_POST['number']) : '';
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $method = mysqli_real_escape_string($conn, $_POST['method']);
    $address = mysqli_real_escape_string($conn, $_POST['flat'] . ', ' . $_POST['street'] . ', ' . $_POST['city'] . ', ' . $_POST['state'] . ', ' . $_POST['country'] . ' - ' . $_POST['pin_code']);
    $placed_on = date('d-M-Y');
    $tracking_number = 'FLRSSTPH' . date('YmdHis') . $user_id;
    $custom_note = isset($_POST['custom_note']) ? $_POST['custom_note'] : '';
    $selected_region = isset($_POST['country']) ? $_POST['country'] : '';

    $placed_on_date = new DateTime($placed_on);
    $first_additional_date = clone $placed_on_date;

    $first_additional_date->modify('+5 day'); 

    $first_additional_date_formatted = $first_additional_date->format('d-M-Y');

    $estimated_arrival_time = "$first_additional_date_formatted";

    if($total_price != 0){
        mysqli_query($conn, "INSERT INTO `orders` (user_id, name, contact_number, email, method, address, total_products, total_price, custom_note, placed_on, tracking_number, delivery_charges, order_type) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$total_price', '$custom_note', '$placed_on','$tracking_number','$delivery_charges','$order_type')") or die('query failed');
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
   <title>Customize</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/new.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Customized Flower</h3>
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
                <span>Rose/s: <?php echo $rose_price; ?></span><br>
                <span>Stock/s: <?php echo $rose_stock; ?></span>
                <select name="rose">
                    <option value="0">none</option>
                    <option value="1">1 pc of Rose</option>
                    <option value="2">2 pcs of Roses</option>
                    <option value="3">3 pcs of Roses</option>
                    <option value="4">4 pcs of Roses</option>
                    <option value="5">5 pcs of Roses</option>
                    <option value="6">6 pcs of Roses</option>
                    <option value="7">7 pcs of Roses</option>
                    <option value="8">8 pcs of Roses</option>
                    <option value="9">9 pcs of Roses</option>
                    <option value="10">10 pcs of Roses</option>
                </select>
            </div>

            <div class="inputBox">
                <div>                    
                    <img src="https://ludaflower.com/wp-content/uploads/2018/06/PT1-600x600.jpg" height="60%" width="30%" alt="Rose Web Picture"/>
                </div>
                <span>Tulip/s: <?php echo $tulip_price; ?></span><br>
                <span>Stock/s: <?php echo $tulip_stock; ?></span>
                <select name="tulip">
                    <option value="0">none</option>
                    <option value="1">1 pc of Tulip</option>
                    <option value="2">2 pcs of Tulips</option>
                    <option value="3">3 pcs of Tulips</option>
                    <option value="4">4 pcs of Tulips</option>
                    <option value="5">5 pcs of Tulips</option>
                    <option value="6">6 pcs of Tulips</option>
                    <option value="7">7 pcs of Tulips</option>
                    <option value="8">8 pcs of Tulips</option>
                    <option value="9">9 pcs of Tulips</option>
                    <option value="10">10 pcs of Tulips</option>
                </select>
            </div>

            <div class="inputBox">
                <div>                    
                    <img src="https://www.craftoutlet.com/media/catalog/product/cache/1/image/1000x1000/9df78eab33525d08d6e5fb8d27136e95/i/m/image_35372.jpg" height="30%" width="15%" alt="Rose Web Picture"/>
                </div>
                <span>Sunflower/s: <?php echo $sunflower_price; ?></span><br>
                <span>sunflower/s: <?php echo $sunflower_stock; ?></span>
                <select name="sunflower">
                    <option value="0">none</option>
                    <option value="1">1 pc of Sunflower</option>
                    <option value="2">2 pcs of Sunflowers</option>
                    <option value="3">3 pcs of Sunflowers</option>
                    <option value="4">4 pcs of Sunflowers</option>
                    <option value="5">5 pcs of Sunflowers</option>
                    <option value="6">6 pcs of Sunflowers</option>
                    <option value="7">7 pcs of Sunflowers</option>
                    <option value="8">8 pcs of Sunflowers</option>
                    <option value="9">9 pcs of Sunflowers</option>
                    <option value="10">10 pcs of Sunflowers</option>
                </select>

                <div class="inputBox">
                    <span>Message/Note: </span>
                    <input type="text" name="custom_note" placeholder="Limit 100 character - indicate color for rose and tulips..." required>
                </div>

            </div>


        </div>

        <h3>Customize your Flower</h3>

        <div class="flex">
        <div class="inputBox">
                <span>Name:</span>
                <input type="text" name="name" placeholder="Enter your name" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>Contact Number:</span>
                <input type="number" name="number" placeholder="+63XXXXXXXXXX" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_contact_number']) ? $_SESSION['user_contact_number'] : ''); ?>" required> required>
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
                <input type="text" name="street" placeholder="e.g. street name" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_flat']) ? $_SESSION['user_street'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>Barangay:</span>
                <input type="text" name="city" placeholder="e.g. Addition Hills" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_flat']) ? $_SESSION['user_barangay'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>City/Municipality:</span>
                <input type="text" name="state" placeholder="e.g. Mandaluyong City" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_flat']) ? $_SESSION['user_city'] : ''); ?>" required>
            </div>
            <div class="inputBox">
                <span>Region:</span>
                <select name="country">
                    <option value="NCR">Region NCR</option>
                    <option value="Region I">Region I</option>
                    <option value="Region II">Region II</option>
                    <option value="Region III">Region III</option>
                    <option value="Region IV-A">Region IV-A</option>
                    <option value="Region IV-B">Region IV-B</option>
                    <option value="Region V">Region V</option>
                    <option value="Region VI">Region VI</option>
                    <option value="Region VII">Region VII</option>
                    <option value="Region IX">Region IX</option>
                    <option value="Region X">Region X</option>
                    <option value="Region XI">Region XI</option>
                    <option value="Region XII">Region XII</option>
                    <option value="Region XIII">Region XIII</option>
                    <option value="Region CAR">Region CAR</option>
                    <option value="Region BARMM">Region BARMM</option>
                </select>
             </div>
            <div class="inputBox">
                <span>Zip Code:</span>
                <input type="number" min="1" name="pin_code" placeholder="e.g. 1550" value="<?php echo ($user_id === 19) ? '' : (isset($_SESSION['user_flat']) ? $_SESSION['user_zip'] : ''); ?>" required>
            </div>
            <input type="hidden" name="order_type" value="customized">
        </div>

        <input type="submit" name="customize" value="Order Now" class="btn">

    </form>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>