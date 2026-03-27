<?php
require '../config/function.php';

$parameter = checkParamId('id');
if (is_numeric($parameter)) {

    $orderedItemId = validate($parameter);

    $orderedItem = getById('orderedItems', $orderedItemId);
    if ($orderedItem['status'] == 200) {

        $deleteQuery = deleteQuery('orderedItems', $orderedItemId);

        if ($deleteQuery) {

            redirect('orderedItems.php', 'Ordered Item Deleted Successfully');
        } else {
            redirect('orderedItems.php', 'Something Went Wrong');
        }
    } else {
        redirect('orderedItems.php', $orderedItem['message']);
    }
} else {
    redirect('orderedItems.php', $parameter);
}
?>