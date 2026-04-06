<?php
require '../config/function.php';

$parameter = checkParamId('id');
if (is_numeric($parameter)) {

    $productId = validate($parameter);

    $product = getById('enquiries', $productId);
    if ($product['status'] == 200) {

        $deleteQuery = deleteQuery('enquiries', $productId);

        if ($deleteQuery) {

            redirect('enquirie.php', 'Enquiry Deleted Successfully');
        } else {
            redirect('enquirie.php', 'Something Went Wrong');
        }
    } else {
        redirect('enquirie.php', $product['message']);
    }
} else {
    redirect('enquirie.php', $parameter);
}
?>