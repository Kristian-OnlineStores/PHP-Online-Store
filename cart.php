<?php

session_start();
include("php/connect.php");

if(!isset($_SESSION['valid'])){
    header("Location: LoginIndex.php");
    exit();
}


if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}


if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id'])) {
    $car_id = intval($_GET['id']);
    
    
    $car_query = $con->prepare("SELECT * FROM cars WHERE id = ?");
    $car_query->bind_param("i", $car_id);
    $car_query->execute();
    $car_result = $car_query->get_result();
    
    if ($car_result->num_rows > 0) {
        if (isset($_SESSION['cart'][$car_id])) {
            $_SESSION['cart'][$car_id]['quantity'] += 1;
        } else {
            $car = $car_result->fetch_assoc();
            $_SESSION['cart'][$car_id] = array(
                'brand' => $car['brand'],
                'model' => $car['model'],
                'price' => $car['price'],
                'quantity' => 1
            );
        }
        header("Location: cart.php?message=added");
        exit();
    }
}


if (isset($_POST['update_cart'])) {
    foreach ($_POST['quantities'] as $id => $quantity) {
        $id = intval($id);
        $quantity = intval($quantity);
        
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id]['quantity'] = $quantity;
        }
    }
    header("Location: cart.php?message=updated");
    exit();
}


if (isset($_GET['remove'])) {
    $remove_id = intval($_GET['remove']);
    if (isset($_SESSION['cart'][$remove_id])) {
        unset($_SESSION['cart'][$remove_id]);
    }
    header("Location: cart.php?message=removed");
    exit();
}


if (isset($_GET['clear'])) {
    $_SESSION['cart'] = array();
    header("Location: cart.php?message=cleared");
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="style/style.css">
    <style>
       
    </style>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"><img src="img/Logo.png" alt="No img" width="60" height="50"></a></p>
        </div>

        <div class="right-links">
            <a href="home.php"><button class="btn">Continue Shopping</button></a>
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

    <div class="cart-container">
        <h2>Shopping Cart</h2>
        
        <?php if (isset($_GET['message'])): ?>
            <?php 
            $messages = [
                'added' => 'Item added to cart!',
                'updated' => 'Cart updated!',
                'removed' => 'Item removed from cart!',
                'cleared' => 'Cart cleared!'
            ];
            if (isset($messages[$_GET['message']])):
            ?>
            <div class="message success"><?php echo $messages[$_GET['message']]; ?></div>
            <?php endif; ?>
        <?php endif; ?>
        
        <?php if (empty($_SESSION['cart'])): ?>
            <div class="empty-cart">
                Your cart is empty. <a href="home.php">Continue shopping?</a>
            </div>
        <?php else: ?>
            <form action="cart.php" method="post">
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $total = 0;
                        foreach ($_SESSION['cart'] as $id => $item): 
                            $item_total = $item['price'] * $item['quantity'];
                            $total += $item_total;
                        ?>
                        <tr>
                            <td><?php echo $item['brand'] . ' ' . $item['model']; ?></td>
                            <td><?php echo number_format($item['price'], 2); ?> lv</td>
                            <td>
                                <input type="number" name="quantities[<?php echo $id; ?>]" 
                                       value="<?php echo $item['quantity']; ?>" 
                                       min="1" class="quantity-input">
                            </td>
                            <td><?php echo number_format($item_total, 2); ?> lv</td>
                            <td>
                                <a href="cart.php?remove=<?php echo $id; ?>">Remove</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="cart-total">
                    Total: <?php echo number_format($total, 2); ?> lv
                </div>
                
                <div style="display: flex; justify-content: space-between;">
                    <input type="submit" name="update_cart" value="Update Cart" class="btn">
                    <a href="cart.php?clear=1" class="btn" style="background: #dc3545;">Clear Cart</a>
                    <a href="checkout.php" class="btn-checkout">Proceed to Checkout</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>