<?php
function validate($input) {
    return trim(htmlspecialchars($input));
}

function normalizeEmail($email) {
    return strtolower(trim($email));
}


function loadUserCart($con, $user_id) {
    $cart_query = $con->prepare("   
        SELECT c.goods_id, c.quantity, g.brand, g.model, g.finalPrice
        FROM cart c
        INNER JOIN goods g ON c.goods_id = g.id
        WHERE c.user_id = ?
    ");

    $cart_query->bind_param("i", $user_id);
    $cart_query->execute();
    $cart_result = $cart_query->get_result();
    
    $_SESSION['cart'] = array();
    while($cart_item = $cart_result->fetch_assoc()){
        
        $_SESSION['cart'][$cart_item['goods_id']] = array(
            'brand' => $cart_item['brand'],
            'model' => $cart_item['model'],
            'finalPrice' => $cart_item['finalPrice'],
            'quantity' => intval($cart_item['quantity']) 
        );
    }
    $cart_query->close();
}
function syncCartWithDatabase($con, $user_id, $session_cart) {
    $delete_stmt = $con->prepare("DELETE FROM cart WHERE user_id = ?");
    $delete_stmt->bind_param("i", $user_id);
    $delete_stmt->execute();
    $delete_stmt->close();
    
    if (!empty($session_cart)) {
        $insert_stmt = $con->prepare("INSERT INTO cart (user_id, goods_id, quantity) VALUES (?, ?, ?)");
        foreach ($session_cart as $goods_id => $item) {
            
            $insert_stmt->bind_param("iii", $user_id, $goods_id, $item['quantity']);
            $insert_stmt->execute();
        }
        $insert_stmt->close();
    }
}




function LoginUser($email, $password, $con) {
    $email = normalizeEmail($email);
$stmt = $con->prepare("SELECT * FROM users WHERE LOWER(Email) = ?");
    
    if($stmt === false) {
        error_log("Login prepare failed: " . $con->error);
        return array('error' => 'System error. Please try again later.');
    }
    
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
    
    if(!is_array($row) || empty($row)) {
        return array('error' => 'Invalid email or password');
    }

     if (isset($row['IsBan']) && $row['IsBan'] == 1) {
        return ['error' => 'Your account has been banned. Please contact support for more information.'];
    }

    if(!password_verify($password, $row['Password'])) {
        return array('error' => 'Invalid email or password');
    }
    
    $_SESSION['id'] = $row['id'];
            $_SESSION['valid'] = $row['Email'];
            $_SESSION['firstName'] = $row['FirstName'];
            $_SESSION['lastName'] = $row['LastName'];
            $_SESSION['role'] = $row['Role'];
            $_SESSION['isBan'] = $row['IsBan'];
    /**/
    
    /* $_SESSION['user'] = [
        'id' => $row['id'],
        'email' => $row['Email'],
        'firstName' => $row['FirstName'],
        'lastName' => $row['LastName'],
        'role' => $row['Role'],
        'isBan' => $row['IsBan']
    ];
    }
    
    loadUserCart($con, $row['id']);
    
  return array(
        'success' => true,
        'role' => $row['Role'] ?? 'user'  // Role с главно R
    );*/
    loadUserCart($con, $row['id']);
    

          return $row['Role'];
   /*return array(
        'success' => true,
        'role' => $row['Role']
    );*/
    
    // 
  
   
}


function RegisterUser($con, $data) {
 $firstName = validate($data['firstName']);
    $lastName = validate($data['lastName']);
    $email = normalizeEmail($data['email']);
    $password = $data['password'];
    $confirmPassword = $data['confirmPassword'];
    
    
    if(empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        return array('error' => 'Please fill all required fields');
    }
    
    
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return array('error' => 'Invalid email format');
    }
    
    
    if($password !== $confirmPassword) {
        return array('error' => 'Passwords do not match');
    }

     $check_stmt = $con->prepare("SELECT id FROM users WHERE LOWER(Email) = ?");
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();
    
    if($check_result->num_rows > 0) {
        $check_stmt->close();
        return array('error' => 'This email is already registered');
    }
    $check_stmt->close();
    
    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';
    $isBan = 0;
    
    
    $insert_stmt = $con->prepare("INSERT INTO users (FirstName, LastName, Email, Password, Role, IsBan) VALUES (?, ?, ?, ?, ?, ?)");
    $insert_stmt->bind_param("sssssi", $firstName, $lastName, $email, $hashedPassword, $role, $isBan);
    
    if($insert_stmt->execute()) {
        $insert_stmt->close();
        return array('success' => true, 'email' => $email);
    } else {
        $insert_stmt->close();
        error_log("Registration failed: " . $con->error);
        return array('error' => 'Registration failed. Please try again.');
    }
}


function isLoggedIn() {
    return isset($_SESSION['id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function checkIfAlreadyLoggedIn() { 
    if(isLoggedIn()) {
        if(isAdmin()) {
            header("Location: ../Admin/index.php");
        } else {
            header("Location: ../home.php");
        }
        exit();
    }
}
/* 


function requireLogin() {
    if(!isLoggedIn()) {
        safeRedirect('../Login-Register-Password/Login.php', 'Please login first');
    }
}

function requireAdmin() {
    requireLogin();
    if(!isAdmin()) {
        safeRedirect('../home.php', 'Access denied');
    }
}

function logoutUser() {
    session_destroy();
    safeRedirect('../../Login-Register-Password/Login.php', 'Logged out successfully');
}*/





                    /////////// Cart functions //////////


function AddToCart($con, $user_id, $goods_id) {
    // Вземи информация за продукта
    $goods_query = $con->prepare("SELECT brand, model, finalPrice FROM goods WHERE id = ?");
    $goods_query->bind_param("i", $goods_id);
    $goods_query->execute();
    $goods_result = $goods_query->get_result();
    
    if ($goods_result->num_rows == 0) {
        return array('error' => 'Product not found');
    }
    
    $goods = $goods_result->fetch_assoc();
    $goods_query->close();
    

    if (isset($_SESSION['cart'][$goods_id])) {
        $_SESSION['cart'][$goods_id]['quantity'] += 1; 
    } else {
        $_SESSION['cart'][$goods_id] = array(
            'brand' => $goods['brand'],
            'model' => $goods['model'],
            'finalPrice' => $goods['finalPrice'], 
            'quantity' => 1 
        );
    }
    
    syncCartWithDatabase($con, $user_id, $_SESSION['cart']);
    
    return array('success' => true);
}

function UpdateCart($con, $user_id, $quantities) {
    // $quantities идва от POST: ["52" => "2", "1" => "1"]
    foreach ($quantities as $goods_id => $quantity) {
        $goods_id = intval($goods_id);
        $quantity = intval($quantity);
        
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$goods_id]);
        } else {
            if (isset($_SESSION['cart'][$goods_id])) {
                $_SESSION['cart'][$goods_id]['quantity'] = $quantity; 
            }
        }
    }
    
    syncCartWithDatabase($con, $user_id, $_SESSION['cart']);
}

function RemoveFromCart($con, $user_id, $goods_id) {
    if (isset($_SESSION['cart'][$goods_id])) {
        unset($_SESSION['cart'][$goods_id]);
    }
    
    syncCartWithDatabase($con, $user_id, $_SESSION['cart']);
}

function ClearCart($con, $user_id) {
    $_SESSION['cart'] = array();
    $result = syncCartWithDatabase($con, $user_id, $_SESSION['cart']);

   if ($result === false) {
        error_log("syncCartWithDatabase returned false");
    } else {
        error_log("Cart successfully cleared");
    
    }
    }

function CartTotal($cart) {
    $total = 0;
    if (!is_array($cart)) {
        return 0;
    }
    foreach ($cart as $item) {
        if (!isset($item['finalPrice']) || !isset($item['quantity'])) {
            continue;
        }
        $price = floatval($item['finalPrice']);
        $quantity = is_numeric($item['quantity']) ? floatval($item['quantity']) : 0;
        $total += $price * $quantity;
    }
    return $total;
}


             ///////////End Cart functions ///////////

               ////////////// Checkout functions /////////////


function processPayment($con, $user_id, $cart, $data) {
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['finalPrice'] * $item['quantity'];
    }
   $validation = validateCheckoutData($data);

    if (isset($validation['error'])){
        return  [
            'success' => false,
            'error' => true,
            'message' => $validation['message']
        ];
    }

    $con->begin_transaction();
    
    try {
        $ordered_id = insertOrder($con, $user_id, $total, $data);
        
        if (!$ordered_id) {
            throw new Exception("Failed to insert order");
        }
        
        $items_inserted = insertOrderItems($con, $ordered_id, $cart);
        
        if (!$items_inserted) {
            throw new Exception("Failed to insert order items");
        }
        
        $con->commit();
        
        return [
            'success' => true,
            'order_id' => $ordered_id,
            'total' => $total,
            'message' => 'Payment successful!'
        ];
        
    } catch (Exception $e) {

        $con->rollback();
        return [
            'success' => false, 
            'error' => true,
            'message' => 'Error processing your order: ' . $e->getMessage()
        ];
    }
}

function validateCheckoutData($data) {

    $required_fields = ['cardName', 'cardNumber', 'cardExpiry', 'cardCvv', 'paymentMethod'];
    foreach ($required_fields as $field) {
        if (empty($data[$field])) {
            return [
                'error' => true,
                'message' => "Please fill in all required fields"
            ];

            //return array('error' => "Please fill in all required fields");
        }
    }
    
    if (!preg_match('/^\d{16}$/', str_replace(' ', '', $data['cardNumber']))) {
      return [
                'error' => true,
                'message' => "Invalid card number"
            ];
    // return array('error' => "Invalid card number");
    }
    
    if (!preg_match('/^\d{3,4}$/', $data['cardCvv'])) {
        return [
                'error' => true,
                'message' => "Invalid CVV"
            ];
       // return array('error' => "Invalid CVV");
    }
    
    if (!preg_match('/^(0[1-9]|1[0-2])\/([0-9]{2})$/', $data['cardExpiry'], $matches)) {
       return [
                'error' => true,
                'message' => "Invalid expiry date - must be MM/YY"
            ];
    // return array('error' => "Invalid expiry date - must be MM/YY");
    }

    $month = $matches[1];
$year = $matches[2];

$currentYear = date('y');
$currentMonth = date('m');

if ($year < $currentYear || ($year == $currentYear && $month < $currentMonth)) {
    return array('error' => "Card has expired");
}

$maxFutureYears = 10; 
if ($year > $currentYear + $maxFutureYears) {
    return array('error' => "Invalid expiry year - too far in the future");
}
    
    return array('success' => true);
}

function insertOrder($con, $user_id, $total, $payment_data) {
    $query = "INSERT INTO orders (user_id, total, paymentMethod, cardName, cardNumber, cardExpiry, cardCvv, paid, orderStatus, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, ?, '1', 'Pending', NOW())";
    
    $stmt = $con->prepare($query);
    $stmt->bind_param("idsssss", 
        $user_id, 
        $total, 
        $payment_data['paymentMethod'], 
        $payment_data['cardName'], 
        $payment_data['cardNumber'], 
        $payment_data['cardExpiry'], 
        $payment_data['cardCvv'],

    );
    
    if ($stmt->execute()) {
        $order_id = $con->insert_id;
        $stmt->close();
        return $order_id;
    }
    
    $stmt->close();
    return false;
}

function insertOrderItems($con, $ordered_id, $cart) {
    $query = "INSERT INTO orderedItems (order_id, goods_id, quantity, price) VALUES (?, ?, ?, ?)";
    $stmt = $con->prepare($query);
    
    foreach ($cart as $goods_id => $item) {
        $goods_id_int = intval($goods_id);
        $quantity = intval($item['quantity']);
        $price = floatval($item['finalPrice']);
        
        $stmt->bind_param("iiid", $ordered_id, $goods_id_int, $quantity, $price);
        
        if (!$stmt->execute()) {
            $stmt->close();
            return false;
        }
    }
    
    $stmt->close();
    return true;
}

function clearCartAfterPayment() {
    $_SESSION['cart'] = array();
    return true;
}

function getOrderDetails($con, $order_id, $user_id = null) {
    $query = "SELECT o.*, 
              (SELECT COUNT(*) FROM orderedItems WHERE order_id = o.id) as item_count 
              FROM orders o 
              WHERE o.id = ?";
    
    if ($user_id !== null) {
        $query .= " AND o.user_id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("ii", $order_id, $user_id);
    } else {
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $order_id);
    }
    
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
        
        $items_query = "SELECT oi.*, g.brand, g.model 
                        FROM orderedItems oi 
                        JOIN goods g ON oi.goods_id = g.id 
                        WHERE oi.order_id = ?";
        $items_stmt = $con->prepare($items_query);
        $items_stmt->bind_param("i", $order_id);
        $items_stmt->execute();
        $items_result = $items_stmt->get_result();
        
        $order['items'] = [];
        while ($item = $items_result->fetch_assoc()) {
            $order['items'][] = $item;
        }
        
        $items_stmt->close();
        $stmt->close();
        
        return [
            'success' => true,
            'order' => $order
        ];
    }
    
    $stmt->close();
    return [
        'success' => false,
        'message' => 'Order not found'
    ];
}

?>