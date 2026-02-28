<?php
require '../config/function.php';

$parameter = checkParamId('id');
if (is_numeric($parameter)) {

    $productId = validate($parameter);

    $product = getById('social_media', $productId);
    if ($product['status'] == 200) {

        $deleteQuery = deleteQuery('social_media', $productId);

        if ($deleteQuery) {

            redirect('social_media.php', 'Product Deleted Successfully');
        } else {
            redirect('social_media.php', 'Something Went Wrong');
        }
    } else {
        redirect('social_media.php', $product['message']);
    }
} else {
    redirect('social_media.php', $parameter);
}
?>