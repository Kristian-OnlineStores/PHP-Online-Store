<?php

session_start();
include("Connect/connect.php");
require_once 'config/function.php';

if(!isset($_SESSION['valid']) || empty($_SESSION['cart'])){
    header("Location: Login.php");
    exit();
}


$id = $_SESSION['id'];
$query = $con->prepare("SELECT * FROM users WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    $res_FirstName = $row['FirstName'];
    $res_LastName = $row['LastName'];
    $res_Email = $row['Email'];
    $res_id = $row['id'];
}

$query->close();


$payment_success = false;
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$data = [
    'cardName' => $_POST['cardName'],
    'cardNumber' => $_POST['cardNumber'],
    'cardExpiry' => $_POST['cardExpiry'],
    'cardCvv' => $_POST['cardCvv'],
    'paymentMethod' => $_POST['paymentMethod']
];

$result = processPayment($con, $id, $_SESSION['cart'], $data);

if ($result['success'] === true) {
        $payment_success = true;
        $order_id = $result['order_id'];
        
        $order_details_result = getOrderDetails($con, $order_id);
        if ($order_details_result['success']) {
            $order_details = $order_details_result['order'];
        }
        
        clearCartAfterPayment();
        
    } else {
        $error_message = $result['message'];
    }
   /* $card_name = $con->real_escape_string($_POST['cardName']);
    $card_number = $con->real_escape_string($_POST['cardNumber']);
    $card_expiry = $con->real_escape_string($_POST['cardExpiry']);
    $card_cvv = $con->real_escape_string($_POST['cardCvv']);
    $payment_method = $con->real_escape_string($_POST['paymentMethod']);
    

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['finalPrice'] * $item['quantity'];
    }
    

 
$clean_card_number = str_replace(' ', '', $card_number);
    if (strlen($clean_card_number) != 16 || !is_numeric($clean_card_number)) {
        $error_message = "Invalid card number";
    } elseif (strlen($card_cvv) < 3 || !is_numeric($card_cvv)) {
        $error_message = "Invalid CVV";
    } elseif (!preg_match('/^(0[1-9]|1[0-2])\/([0-9]{2})$/', $card_expiry)) {
    $error_message = "Invalid expiry date - must be MM/YY";
}else {

        
        
        $insert_order = $con->prepare("INSERT INTO orders (user_id, total, paymentMethod, cardName, cardNumber, cardExpiry, cardCvv) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_order->bind_param("idsssss", $res_id, $total, $payment_method, $card_name, $card_number, $card_expiry, $card_cvv);
        
        if ($insert_order->execute()) {
            $payment_success = true;
            $order_id = $con->insert_id;
            
            
            $_SESSION['cart'] = array();
        } else {
            $error_message = "Error processing your order. Please try again.";
        }
        
        $insert_order->close();
    }*/
}
$cart_total = 0;
foreach ($_SESSION['cart'] as $item) {
    $cart_total += $item['finalPrice'] * $item['quantity'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"><img src="../assets/img/Logo.png" alt="No img" width="60" height="50"></a></p>
        </div>

        <div class="right-links">
            <a href="cart.php"><button class="btn">Back to Cart</button></a>
            <a href="complain.php"> <button class="btn">Complain</button></a>
            <div class="dropdown">
                <button class="dropbtn"> <b><?php echo $res_FirstName . ' ' . $res_LastName; ?></b></button>
                <div class="dropdown-content">
                    <a href="update.php?Id=<?php echo $res_id; ?>">Update Profile</a>
                    <a href="logout.php">Log Out</a>
                </div>
            </div>
            
        </div>
    </div>

    <div class="checkout-container">
        <h2>Checkout</h2>
        
        <?php if ($payment_success): ?>
            <div class="success-message">
                <h3>Payment Successful!</h3>
                <p>Thank you for your purchase. Your order has been placed successfully.</p>
                <p>Order ID: #<?php echo $order_id; ?></p>

                <a href="../home.php" class="btn">Continue Shopping</a>
            </div>
        <?php else: ?>
            <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
            
            <div class="order-summary">
                <h3>Order Summary</h3>
                <?php 
                $total = 0;
                foreach ($_SESSION['cart'] as $id => $item): 
                    $item_total = $item['finalPrice'] * $item['quantity'];
                    $total += $item_total;
                ?>
                <div class="order-item">
                    <span><?php echo $item['brand'] . ' ' . $item['model'] . ' x ' . $item['quantity']; ?></span>
                    <span>€<?php echo number_format($item_total, 2); ?></span>
                </div>
                <?php endforeach; ?>
                <div class="order-item order-total">
                    <span>Total:</span>
                    <span>€<?php echo number_format($total, 2); ?></span>
                </div>
            </div>
            
            <form action="checkout.php" method="post" class="checkout-form">
                <div class="form-group full-width">
                    <h3>Payment Information</h3>
                </div>
                
                <div class="form-group">
                    <label for="paymentMethod">Payment Method</label>
                    <select name="paymentMethod" id="paymentMethod" required>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Debit Card">Debit Card</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="cardName">Card Holder Name</label>
                    <input type="text" name="cardName" id="cardName" required>
                </div>
                
                <div class="form-group">
                    <label for="cardNumber">Card Number</label>
                    <input type="text" name="cardNumber" id="cardNumber" placeholder="1234 5678 9012 3456" pattern="[0-9\s]{16,19}"  maxlength="19" 
                     oninput="this.value = this.value.replace(/[^0-9\s]/g, '').replace(/(\d{4})(?=\d)/g, '$1 ').trim()" required>
                </div>
                
                <div class="form-group">
                    <label for="cardExpiry">Expiry Date</label>
                    <input type="text" name="cardExpiry" id="cardExpiry" placeholder="MM/YY"  pattern="(0[1-9]|1[0-2])\/([0-9]{2})" maxlength="5" 
                     oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\d{2})(?=\d)/g, '$1/').trim()" required>
                </div>
                
                <div class="form-group">
                    <label for="cardCvv">CVV</label>
                    <input type="text" name="cardCvv" id="cardCvv" placeholder="123" maxlength="3" 
                     oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 3)" required>
                </div>
                
                <div class="form-group full-width">
                    <button type="submit" class="btn-pay">Pay Now</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>