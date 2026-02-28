<?php
require '../config/function.php';

$parameter = checkParamId('id');
if (is_numeric($parameter)) {

    $productId = validate($parameter);

    $product = getById('orders', $productId);
    if ($product['status'] == 200) {

        $deleteQuery = deleteQuery('orders', $productId);

        if ($deleteQuery) {

            redirect('orders.php', 'Product Deleted Successfully');
        } else {
            redirect('orders.php', 'Something Went Wrong');
        }
    } else {
        redirect('orders.php', $user['message']);
    }
} else {
    redirect('orders.php', $parameter);
}
?>