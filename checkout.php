<?php

session_start();
include("php/connect.php");

if(!isset($_SESSION['valid']) || empty($_SESSION['cart'])){
    header("Location: LoginIndex.php");
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

    $card_name = $con->real_escape_string($_POST['card_name']);
    $card_number = $con->real_escape_string($_POST['card_number']);
    $card_expiry = $con->real_escape_string($_POST['card_expiry']);
    $card_cvv = $con->real_escape_string($_POST['card_cvv']);
    $payment_method = $con->real_escape_string($_POST['payment_method']);
    

    $total = 0;
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    

    if (strlen($card_number) < 16 || !is_numeric($card_number)) {
        $error_message = "Invalid card number";
    } elseif (strlen($card_cvv) < 3 || !is_numeric($card_cvv)) {
        $error_message = "Invalid CVV";
    } else {

        
        
        $insert_order = $con->prepare("INSERT INTO orders (user_id, total, payment_method, card_name, card_number, card_expiry, card_cvv) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insert_order->bind_param("idsssss", $res_id, $total, $payment_method, $card_name, $card_number, $card_expiry, $card_cvv);
        
        if ($insert_order->execute()) {
            $payment_success = true;
            $order_id = $con->insert_id;
            
            
            $_SESSION['cart'] = array();
        } else {
            $error_message = "Error processing your order. Please try again.";
        }
        
        $insert_order->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"><img src="img/Logo.png" alt="No img" width="60" height="50"></a></p>
        </div>

        <div class="right-links">
            <a href="cart.php"><button class="btn">Back to Cart</button></a>
            <a href="complain.php"> <button class="btn">Complain</button></a>
            <div class="dropdown">
                <button class="dropbtn"> <b><?php echo $res_FirstName . ' ' . $res_LastName; ?></b></button>
                <div class="dropdown-content">
                    <a href="update.php?Id=<?php echo $res_id; ?>">Update Profile</a>
                    <a href="php/logout.php">Log Out</a>
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
                <a href="home.php" class="btn">Continue Shopping</a>
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
                    $item_total = $item['price'] * $item['quantity'];
                    $total += $item_total;
                ?>
                <div class="order-item">
                    <span><?php echo $item['brand'] . ' ' . $item['model'] . ' x ' . $item['quantity']; ?></span>
                    <span>$<?php echo number_format($item_total, 2); ?></span>
                </div>
                <?php endforeach; ?>
                <div class="order-item order-total">
                    <span>Total:</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
            </div>
            
            <form action="checkout.php" method="post" class="checkout-form">
                <div class="form-group full-width">
                    <h3>Payment Information</h3>
                </div>
                
                <div class="form-group">
                    <label for="payment_method">Payment Method</label>
                    <select name="payment_method" id="payment_method" required>
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="card_name">Name on Card</label>
                    <input type="text" name="card_name" id="card_name" required>
                </div>
                
                <div class="form-group">
                    <label for="card_number">Card Number</label>
                    <input type="text" name="card_number" id="card_number" placeholder="1234 5678 9012 3456" required>
                </div>
                
                <div class="form-group">
                    <label for="card_expiry">Expiry Date</label>
                    <input type="text" name="card_expiry" id="card_expiry" placeholder="MM/YY" required>
                </div>
                
                <div class="form-group">
                    <label for="card_cvv">CVV</label>
                    <input type="text" name="card_cvv" id="card_cvv" placeholder="123" required>
                </div>
                
                <div class="form-group full-width">
                    <button type="submit" class="btn-pay">Pay Now</button>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>