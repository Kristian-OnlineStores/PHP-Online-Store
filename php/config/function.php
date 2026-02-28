<?php

function validate($input) {
    return trim(htmlspecialchars($input));
}

function normalizeEmail($email) {
    return strtolower(trim($email));
}


function loadUserCart($con, $user_id) {
    $cart_query = $con->prepare("   
        SELECT c.goods_id, c.quantity, g.brand, g.model, g.price
        FROM cart c
        INNER JOIN goods g ON c.goods_id = g.id
        WHERE c.user_id = ?
    ");

    $cart_query->bind_param("i", $user_id);
    $cart_query->execute();
    $cart_result = $cart_query->get_result();
    
    $_SESSION['cart'] = array();
    while($cart_item = $cart_result->fetch_assoc()){
        // quantity идва от базата като ЧИСЛО!
        $_SESSION['cart'][$cart_item['goods_id']] = array(
            'brand' => $cart_item['brand'],
            'model' => $cart_item['model'],
            'price' => $cart_item['price'],
            'quantity' => intval($cart_item['quantity']) // ← УВЕРЕНИЕ, ЧЕ Е ЧИСЛО
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
    
    // Проверка за празни полета
    if(empty($firstName) || empty($lastName) || empty($email) || empty($password)) {
        return array('error' => 'Please fill all required fields');
    }
    
    // Проверка на имейл формат
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return array('error' => 'Invalid email format');
    }
    
    // Проверка на паролите
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
    
    // Хеширане на паролата
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $role = 'user';
    $isBan = 0;
    
    // Вмъкване в базата с prepared statement
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



function AddToCart($con, $user_id, $goods_id) {
    // Вземи информация за продукта
    $goods_query = $con->prepare("SELECT brand, model, price FROM goods WHERE id = ?");
    $goods_query->bind_param("i", $goods_id);
    $goods_query->execute();
    $goods_result = $goods_query->get_result();
    
    if ($goods_result->num_rows == 0) {
        return array('error' => 'Product not found');
    }
    
    $goods = $goods_result->fetch_assoc();
    $goods_query->close();
    
    // Добави/обнови в сесията - quantity е ЧИСЛО!
    if (isset($_SESSION['cart'][$goods_id])) {
        $_SESSION['cart'][$goods_id]['quantity'] += 1; // ЧИСЛО + 1 = ЧИСЛО
    } else {
        $_SESSION['cart'][$goods_id] = array(
            'brand' => $goods['brand'],
            'model' => $goods['model'],
            'price' => $goods['price'],
            'quantity' => 1 // ← ЧИСЛО, НЕ МАСИВ!
        );
    }
    
    // Синхронизирай с базата
    syncCartWithDatabase($con, $user_id, $_SESSION['cart']);
    
    return array('success' => true);
}

function UpdateCart($con, $user_id, $quantities) {
    // $quantities идва от POST: ["52" => "2", "1" => "1"]
    foreach ($quantities as $goods_id => $quantity) {
        $goods_id = intval($goods_id);
        $quantity = intval($quantity); // ← ПРЕВРЪЩАМЕ В ЧИСЛО!
        
        if ($quantity <= 0) {
            unset($_SESSION['cart'][$goods_id]);
        } else {
            if (isset($_SESSION['cart'][$goods_id])) {
                $_SESSION['cart'][$goods_id]['quantity'] = $quantity; // ← ЧИСЛО!
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
        if (!isset($item['price']) || !isset($item['quantity'])) {
            continue;
        }
        $price = floatval($item['price']);
        $quantity = is_numeric($item['quantity']) ? floatval($item['quantity']) : 0;
        $total += $price * $quantity;
    }
    return $total;
}
?>