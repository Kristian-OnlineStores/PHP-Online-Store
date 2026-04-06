<?php
//require 'config/function.php';
require_once __DIR__ . '/config/function.php';

                //////////////// Users ////////////////

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

                         ////////////////////////End Users ////////////////////////

                             //////////////////////// Products ////////////////////////

if(isset($_POST['saveProduct'])) {
    $brand = validate($_POST['brand']);
    $model = validate($_POST['model']);
    $year = validate($_POST['year']);
    $price = validate($_POST['price']);
    
    $sale_status = isset($_POST['saleCheckbox']) ? 1 : 0;
    //$sale_status = isset($_POST['Sale']) ? validate($_POST['Sale']) : 0;
   
    if($sale_status == 1 && isset($_POST['discountPercent']) && $_POST['discountPercent'] != '') {
        $discount_percent = validate($_POST['discountPercent']);
        //$final_price = validate($_POST['finalPrice']);
        $final_price = $price - ($price * $discount_percent / 100);
    } else {
        $discount_percent = 'NULL';
        $final_price = $price;
        $sale_status = 0; 
    }
    
    if($discount_percent == 'NULL') {
        $query = "INSERT INTO goods (brand, model, year, price, saleStatus, discountPercent, finalPrice) 
                  VALUES ('$brand', '$model', '$year', '$price', '$sale_status', NULL, '$final_price')";
    } else {
        $query = "INSERT INTO goods (brand, model, year, price, saleStatus, discountPercent, finalPrice) 
                  VALUES ('$brand', '$model', '$year', '$price', '$sale_status', '$discount_percent', '$final_price')";
    }
    
    $result = mysqli_query($con, $query);
    
    if($result) {
        redirect('Products/products.php', 'Product added successfully!');
    } else {
        redirect('goods-create.php', 'Something went wrong!');
    }
}

if (isset($_POST['updateProduct'])) {
    $brand = validate($_POST['brand']);
    $model = validate($_POST['model']);
    $year = validate($_POST['year']);
    $price = validate($_POST['price']);
    $sale_status = isset($_POST['saleCheckbox']) ? 1 : 0;

    $discount_percent = !empty($_POST['discountPercent']) ? validate($_POST['discountPercent']) : null;

    $final_price = null;
    if ($sale_status == 1 && $discount_percent !== null && $discount_percent > 0) {
        $final_price = $price - ($price * $discount_percent / 100);
    }else {
        $final_price = $price;
        $sale_status = 0; 
    }   

    $productId = validate($_POST['goodsId']);

    if ($brand != '' && $model != '' && $year != '' && $price != '') {
        $query = "UPDATE goods SET brand='$brand', model='$model', year='$year', price='$price', saleStatus='$sale_status',  discountPercent=" . ($discount_percent !== null ? "'$discount_percent'" : "NULL") . ",
                    finalPrice=" . ($final_price !== null ? "'$final_price'" : "NULL") . "  WHERE id='$productId'";
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

                 ////////////////End Products ////////////////

                   //////////////// Orders ////////////////

if (isset($_POST['saveOrder'])) {
    $user_id = validate($_POST['userId']);
    $total = validate($_POST['total']);
    $payment_method = validate($_POST['paymentMethod']);
    $card_name = validate($_POST['cardName']);
    $card_number = validate($_POST['cardNumber']);
    $card_expiry = validate($_POST['cardExpiry']);
    $card_cvv = validate($_POST['cardCvv']);
    $paid = isset($_POST['paid']) ? 1 : 0;
    $order_status = validate($_POST['orderStatus']);



    if ($user_id != '' && $total != '' && $payment_method != '' && $card_name != '' && $card_number != '' && $card_expiry != '' && $card_cvv != ''  && $order_status != '') {
        $query = "INSERT INTO orders (user_id, total, paymentMethod, cardName, cardNumber, cardExpiry, cardCvv, paid, orderStatus) VALUES 
                                   ('$user_id', '$total', '$payment_method', '$card_name', '$card_number', '$card_expiry', '$card_cvv', '$paid', '$order_status')";
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

if(isset($_POST['updateOrder'])) {
    $user_id = validate($_POST['userId']);
    $total = validate($_POST['total']);
    $payment_method = validate($_POST['paymentMethod']);
    $card_name = validate($_POST['cardName']);
    $card_number = validate($_POST['cardNumber']);
    $card_expiry = validate($_POST['cardExpiry']);
    $card_cvv = validate($_POST['cardCvv']);
    $paid = isset($_POST['paid']) ? 1 : 0;
    $order_status = validate($_POST['orderStatus']);

    $orderId = validate($_POST['orderId']);
  $order = getById('orders', $orderId);
  
  if ($order['status'] != 200) {
    redirect('Orders/orders-edit.php?id='.$orderId, 'No such order found');
  }
    
    if ($user_id != '' && $total != '' && $payment_method != '' && $card_name != '' && $card_number != '' && $card_expiry != '' && $card_cvv != ''  && $order_status != '') {
        $query = "UPDATE orders SET user_id='$user_id', total='$total', paymentMethod='$payment_method', cardName='$card_name', cardNumber='$card_number', cardExpiry='$card_expiry', cardCvv='$card_cvv', paid='$paid', orderStatus='$order_status' WHERE id='$orderId'";
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

                ////////////////End Orders ////////////////

                   ////////////////Ordered Items ////////////////

    if(isset($_POST['saveOrderedItem'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $goods_id = mysqli_real_escape_string($conn, $_POST['goods_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    
    if($order_id != '' && $goods_id != '' && $quantity != '' && $price != '') {
    $query = "INSERT INTO orderedItems (order_id, goods_id, quantity, price) VALUES ('$order_id', '$goods_id', '$quantity', '$price')";
    
    $result = mysqli_query($con, $query);
    
    if($result) {
        redirect('Ordered_Items/orderedItems.php', 'Ordered Item added successfully.');
    } else {
        redirect('Ordered_Items/orderedItems-create.php', 'Something went wrong.');
    }
}else {
        redirect('Ordered_Items/orderedItems-create.php', 'Please fill all input fields');
    }
}

if (isset($_POST['updateOrderedItem'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $goods_id = mysqli_real_escape_string($conn, $_POST['goods_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $orderedItemId = mysqli_real_escape_string($conn, $_POST['orderedItemId']);

    if ($order_id != '' && $goods_id != '' && $quantity != '' && $price != '') {
        $query = "UPDATE orderedItems SET order_id='$order_id', goods_id='$goods_id', quantity='$quantity', price='$price' WHERE id='$orderedItemId'";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Ordered_Items/orderedItems.php', 'Ordered Item Updated Successfully');
        } else {
            redirect('Ordered_Items/orderedItems-edit.php?id='.$orderedItemId, 'Something Went Wrong');
        }
    } else {
        redirect('Ordered_Items/orderedItems-edit.php?id='.$orderedItemId, 'Please fill all input fields');
    }
}

                   //////////////////////// End Ordered Items ////////////////// 

                      //////////////////////// Services ////////////////// 

if (isset($_POST['saveService'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = isset($_POST['status']) ? 1 : 0;

    if ($name != '' && $description != '' ) {
        $query = "INSERT INTO services (Name, Description, Status) VALUES ('$name', '$description', '$status')";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Service/services.php', 'Service Created Successfully');
        } else {
            redirect('Service/services-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('Service/services-create.php', 'Please fill all input fields');
    }
}

if (isset($_POST['updateService'])) {
    $name = validate($_POST['name']);
    $description = validate($_POST['description']);
    $status = validate($_POST['status']) == true? 1 : 0;
    $serviceId = validate($_POST['serviceId']);

    if ($name != '' && $description != '' ) {   
        $query = "UPDATE services SET Name='$name', Description='$description', Status='$status' WHERE id='$serviceId'";
        $result = mysqli_query($con, $query);
        if ($result) {
            redirect('Service/services.php', 'Service Updated Successfully');
        } else {
            redirect('Service/services-edit.php?id='.$ServiceId, 'Something Went Wrong');
        }
    } else {
        redirect('Service/services-edit.php?id='.$ServiceId, 'Please fill all input fields');
    }
}

                   //////////////////////// End Services ////////////////// 

                      //////////////////////// Social Media ////////////////// 

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

                   //////////////////////// End Social Media ////////////////// 

                      //////////////////////// Enquiries ////////////////// 

if (isset($_POST['saveEnquiry'])) {
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $service = validate($_POST['service']);
    $message = validate($_POST['message']);

    if ($name != '' && $email != ''  && $message != '') {
        $query = "INSERT INTO enquiries (Name, Email, Service, Message) VALUES ('$name', '$email', '$service', '$message')";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Enquiries/enquirie.php', 'Enquiry Created Successfully');
        } else {
            redirect('Enquiries/enquirie-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('Enquiries/enquirie-create.php', 'Please fill all input fields');
    }
}

if (isset($_POST['updateEnquiry'])) {
    $Name = validate($_POST['name']);
    $Email = validate($_POST['email']);
    $Service = validate($_POST['service']);
    $Message = validate($_POST['message']);
    $EnquiryId = validate($_POST['enquiryId']);

    if ($Name != '' && $Email != ''  && $Message != '') {
        if ($Service == '' || $Service == 'Select' || $Service == 'NULL') {
            $Service = ' ';
        }
        $query = "UPDATE enquiries SET Name='$Name', Email='$Email', Service='$Service', Message='$Message' WHERE id='$EnquiryId'";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Enquiries/enquirie.php', 'Enquiry Updated Successfully');
        } else {
            redirect('Enquiries/enquirie-edit.php?id='.$EnquiryId, 'Something Went Wrong');
        }
    } else {
        redirect('Enquiries/enquirie-edit.php?id='.$EnquiryId, 'Please fill all input fields');
    }
}

                   //////////////////////// End Enquiries ////////////////// 

                      //////////////////////// Cart ////////////////// 

                      if (isset($_POST['saveCart'])) {
    $user_id = validate($_POST['user_id']);
    $goods_id = validate($_POST['goods_id']);
    $quantity = validate($_POST['quantity']);

    if ($user_id != '' && $goods_id != '' && $quantity != '') {
        $query = "INSERT INTO cart (user_id, goods_id, quantity) VALUES ('$user_id', '$goods_id', '$quantity')";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Peoples_Carts/carts.php', 'Cart Created Successfully');
        } else {
            redirect('Peoples_Carts/carts-create.php', 'Something Went Wrong');
        }
    } else {
        redirect('Peoples_Carts/carts-create.php', 'Please fill all input fields');
    }
}

if (isset($_POST['updateCart'])) {
    $user_id = validate($_POST['user_id']);
    $goods_id = validate($_POST['goods_id']);
    $quantity = validate($_POST['quantity']);
    $cartId = validate($_POST['cartId']);

    if ($user_id != '' && $goods_id != '' && $quantity != '') {
        $query = "UPDATE cart SET user_id='$user_id', goods_id='$goods_id', quantity='$quantity' WHERE id='$cartId'";
        $result = mysqli_query($con, $query);

        if ($result) {
            redirect('Peoples_Carts/carts.php', 'Cart Updated Successfully');
        } else {
            redirect('Peoples_Carts/carts-edit.php?id='.$cartId, 'Something Went Wrong');
        }
    } else {
        redirect('Peoples_Carts/carts-edit.php?id='.$cartId, 'Please fill all input fields');
    }
}

                   //////////////////////// End Cart ////////////////// 

                      //////////////////////// Settings ////////////////// 
if (isset($_POST['saveSetting'])) {
    $settingID = validate($_POST['settingID']);

    $tittle = validate($_POST['title']);
    $url = validate($_POST['url']);
    $small_description = validate($_POST['small_description']);

    $meta_description = validate($_POST['meta_description']);
    $meta_keyword = validate($_POST['meta_keyword']);

    $email = validate($_POST['email']);
    $email2 = validate($_POST['email2']);
    $phone = validate($_POST['phone']);
    $phone2 = validate($_POST['phone2']);
    $address = validate($_POST['address']);
if ($settingID == 'insert') {
 if ($tittle != '' && $url != '' && $small_description != '') {
        $query = "INSERT INTO settings (title, url, small_description, meta_description, meta_keyword, email, email2, phone, phone2, address) 
        VALUES ('$tittle', '$url', '$small_description', '$meta_description', '$meta_keyword', '$email', '$email2', '$phone', '$phone2', '$address')";
        $result = mysqli_query($con, $query);
}
}

if ($settingID != 'insert' || is_numeric($settingID)) {
    
        $query = "UPDATE settings SET title='$tittle', url='$url', small_description='$small_description', meta_description='$meta_description', meta_keyword='$meta_keyword', email='$email',
        email2='$email2', phone='$phone', phone2='$phone2', address='$address' WHERE id='$settingID'";
        $result = mysqli_query($con, $query);
    
}
        if ($result) {
            redirect('Settings/settings.php', 'Settings Saved Successfully');
        } else {
            redirect('Settings/settings-create.php', 'Something Went Wrong');
        }
    

}
?>