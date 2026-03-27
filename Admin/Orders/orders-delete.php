<?php
require '../config/function.php';

$parameter = checkParamId('id');
if (is_numeric($parameter)) {

    $orderId = validate($parameter);

    $order = getById('orders', $orderId);
    if ($order['status'] == 200) {

        $deleteQuery = deleteQuery('orders', $orderId);

        if ($deleteQuery) {

            redirect('orders.php', 'Order Deleted Successfully');
        } else {
            redirect('orders.php', 'Something Went Wrong');
        }
    } else {
        redirect('orders.php', $order['message']);
    }
} else {
    redirect('orders.php', $parameter);
}
?>