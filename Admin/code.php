<?php
//require 'config/function.php';
require_once __DIR__ . '/config/function.php';

         //////// Users ////////

if (isset($_POST['saveUser'])) 
    {
        $FirstName = validate( $_POST['firstname']);
        $LastName = validate($_POST['lastname']);
        $Email = validate($_POST['email']);
        $Password = validate($_POST['password']);
        $PasswordHSH = password_hash($Password, PASSWORD_DEFAULT);

        $Role = validate($_POST['role']);
        //$IsBan = validate($_POST['is_ban']) ? 1 : 0;
    $IsBan = isset($_POST['is_ban']) ? 1 : 0;

    if($FirstName != '' && $LastName != '' && $Email != '' && $Password != '') 
{
 $query = "Insert INTO users (FirstName, LastName, Email, Password, Role, IsBan) VALUES ('$FirstName', '$LastName', '$Email', '$PasswordHSH', '$Role', '$IsBan')";
 $result = mysqli_query($con, $query);
 

 if($result){
    redirect('Users/users.php','User/Admin Created Successfully');
 }else{
    redirect('Users/users-create.php','Something Went Wrong');
 }
}
else
{
  redirect('Users/users-create.php','Please fill all input fields');
}
}

if (isset($_POST['updateUser'])) 
    {
    $FirstName = validate($_POST['firstname']);
    $LastName = validate($_POST['lastname']);
    $Email = validate($_POST['email']);
    $Password = validate($_POST['password']);
    

    $Role = validate($_POST['role']);
    $IsBan = validate($_POST['is_ban']) == true? 1 : 0;

$userId = validate($_POST['userId']);
  $user = getById('users', $userId);
  
  if ($user['status'] != 200) {
    redirect('Users/users-edit.php?id='.$userId, 'No such user found');
  }


    if($FirstName != '' && $LastName != '' && $Email != '') 
    {

   if (!empty($Password)) {
    // If a new password is provided
    $PasswordHSH = password_hash($Password, PASSWORD_DEFAULT);

    $query = "UPDATE users SET 
        FirstName='$FirstName',
        LastName='$LastName',
        Email='$Email',
        Password='$PasswordHSH',
        Role='$Role',
        IsBan='$IsBan'
        WHERE id='$userId'";
} else {
    // If no new password is provided, keep the existing password
    $query = "UPDATE users SET 
        FirstName='$FirstName',
        LastName='$LastName',
        Email='$Email',
        Role='$Role',
        IsBan='$IsBan'
        WHERE id='$userId'";
}

        $result = mysqli_query($con, $query);

        if($result){
            redirect('Users/users.php','User/Admin Updated Successfully');
        }else{
            redirect('Users/users-edit.php?id='.$userId,'Something Went Wrong');
        }
    }
    else
    {
        redirect('Users/users-edit.php?id='.$userId,'Please fill all input fields');
    }
}

         //////// Products ////////

if (isset($_POST['saveProduct'])) {
    $brand = validate($_POST['brand']);
    $model = validate($_POST['model']);
    $year = validate($_POST['year']);
    $price = validate($_POST['price']);
    $IsOnSale = isset($_POST['IsOnSale']) ? 1 : 0;
    

    if ($brand != '' && $model != '' && $year != '' && $price != '') {
        $query = "INSERT INTO goods (brand, model, year, price, IsOnSale) VALUES ('$brand', '$model', '$year', '$price', '$IsOnSale')";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Products/goods.php', 'Product Created Successfully');
        } else {
            redirect('Products/goods-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('Products/goods-create.php', 'Please fill all input fields');
    }

    if ($IsOnSale){
        
    }
}

if (isset($_POST['updateProduct'])) {
    $brand = validate($_POST['brand']);
    $model = validate($_POST['model']);
    $year = validate($_POST['year']);
    $price = validate($_POST['price']);
    $IsOnSale = isset($_POST['IsOnSale']) == true? 1 : 0;
    $productId = validate($_POST['productId']);

    if ($brand != '' && $model != '' && $year != '' && $price != '') {
        $query = "UPDATE goods SET brand='$brand', model='$model', year='$year', price='$price', IsOnSale='$IsOnSale' WHERE id='$productId'";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Products/products.php', 'Product Updated Successfully');
        } else {
            redirect('Products/goods-edit.php?id='.$productId, 'Something Went Wrong');
        }
    } else {
        redirect('Products/goods-edit.php?id='.$productId, 'Please fill all input fields');
    }
}

         //////// Orders ////////

if (isset($_POST['saveOrders'])) {
    $user_id = validate($_POST['user_id']);
    $total = validate($_POST['total']);
    $payment_method = validate($_POST['payment_method']);
    $card_name = validate($_POST['card_name']);
    $card_number = validate($_POST['card_number']);
    $card_expiry = validate($_POST['card_expiry']);
    $card_cvv = validate($_POST['card_cvv']);
    $order_status = validate($_POST['order_status']);

    if ($user_id != '' && $total != '' && $payment_method != '' && $card_name != '' && $card_number != '' && $card_expiry != '' && $card_cvv != '' && $order_status != '') {
        $query = "INSERT INTO orders (user_id, total, payment_method, card_name, card_number, card_expiry, card_cvv, order_status) VALUES ('$user_id', '$total', '$payment_method', '$card_name', '$card_number', '$card_expiry', '$card_cvv', '$order_status')";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Orders/orders.php', 'Order Created Successfully');
        } else {
            redirect('Orders/orders-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('Orders/orders-create.php', 'Please fill all input fields');
    }
}   

if(isset($_POST['updateOrders'])) {
    $user_id = validate($_POST['user_id']);
    $total = validate($_POST['total']);
    $payment_method = validate($_POST['payment_method']);
    $card_name = validate($_POST['card_name']);
    $card_number = validate($_POST['card_number']);
    $card_expiry = validate($_POST['card_expiry']);
    $card_cvv = validate($_POST['card_cvv']);
    $order_status = validate($_POST['order_status']);
    $orderId = validate($_POST['orderId']);

    if ($user_id != '' && $total != '' && $payment_method != '' && $card_name != '' && $card_number != '' && $card_expiry != '' && $card_cvv != '' && $order_status != '') {
        $query = "UPDATE orders SET user_id='$user_id', total='$total', payment_method='$payment_method', card_name='$card_name', card_number='$card_number', card_expiry='$card_expiry', card_cvv='$card_cvv', order_status='$order_status' WHERE id='$orderId'";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Orders/orders.php', 'Order Updated Successfully');
        } else {
            redirect('Orders/orders-edit.php?id='.$orderId, 'Something Went Wrong');
        }
    } else {
        redirect('Orders/orders-edit.php?id='.$orderId, 'Please fill all input fields');
    }
}

            //////// Social Media ////////  

if (isset($_POST['saveSocialMedia'])) {
    $name = validate($_POST['name']);
    $url = validate($_POST['url']);
    $status = isset($_POST['Status']) ? 1 : 0;

    if ($name != '' && $url != '' ) {
        $query = "INSERT INTO social_media (Name, Url, Media_Status) VALUES ('$name', '$url', '$status')";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Social_Media/social_media.php', 'Social Media Created Successfully');
        } else {
            redirect('Social_Media/social_media-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('Social_Media/social_media-create.php', 'Please fill all input fields');
    }
}

if (isset($_POST['updateSocialMedia'])) {
    $Name = validate($_POST['name']);
    $Url = validate($_POST['url']);
    // die(var_dump($_POST['Media_Status']));  Debugging line to check the value of 'Status_media'
    $Status = validate($_POST['Media_Status']) == true? 1 : 0;
    $SocialMediaId = validate($_POST['socialMediaId']);

    if ($Name != '' && $Url != '' ) {   
        $query = "UPDATE social_media SET Name='$Name', Url='$Url', Media_Status='$Status' WHERE id='$SocialMediaId'";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Social_Media/social_media.php', 'Social Media Updated Successfully');
        } else {
            redirect('Social_Media/social_media-edit.php?id='.$SocialMediaId, 'Something Went Wrong');
        }
    } else {
        redirect('Social_Media/social_media-edit.php?id='.$SocialMediaId, 'Please fill all input fields');
    }
}
?>