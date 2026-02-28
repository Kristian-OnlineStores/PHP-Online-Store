<?php
require '../config/function.php';

$parameter = checkParamId('id');
if (is_numeric($parameter)) {

    $productId = validate($parameter);

    $product = getById('goods', $productId);
    if ($product['status'] == 200) {

        $deleteQuery = deleteQuery('goods', $productId);

        if ($deleteQuery) {

            redirect('products.php', 'Product Deleted Successfully');
        } else {
            redirect('products.php', 'Something Went Wrong');
        }
    } else {
        redirect('products.php', $user['message']);
    }
} else {
    redirect('products.php', $parameter);
}
?>