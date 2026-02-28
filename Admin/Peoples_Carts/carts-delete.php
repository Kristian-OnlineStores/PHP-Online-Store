<?php
require '../config/function.php';

$parameter = checkParamId('id');
if (is_numeric($parameter)) {

    $productId = validate($parameter);

    $product = getById('cart', $productId);
    if ($product['status'] == 200) {

        $deleteQuery = deleteQuery('cart', $productId);

        if ($deleteQuery) {

            redirect('carts.php', 'Cart Deleted Successfully');
        } else {
            redirect('carts.php', 'Something Went Wrong');
        }
    } else {
        redirect('carts.php', $product['message']);
    }
} else {
    redirect('carts.php', $parameter);
}
?>