<?php
require '../config/function.php';

$parameter = checkParamId('id');
if (is_numeric($parameter)) {

    $orderedItemId = validate($parameter);

    $orderedItem = getById('services', $orderedItemId);
    if ($orderedItem['status'] == 200) {

        $deleteQuery = deleteQuery('services', $orderedItemId);

        if ($deleteQuery) {

            redirect('services.php', 'Service Deleted Successfully');
        } else {
            redirect('services.php', 'Something Went Wrong');
        }
    } else {
        redirect('services.php', $orderedItem['message']);
    }
} else {
    redirect('services.php', $parameter);
}
?>