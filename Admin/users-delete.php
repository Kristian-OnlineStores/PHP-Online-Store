
<?php
require '../Admin/config/function.php';

$parameter = checkParamId('id');
if(is_numeric($parameter)){

    $userId = validate($parameter);

    $user = getById('users', $userId);
    if($user['status'] == 200){

        $deleteQuery = deleteQuery('users', $userId);

        if($deleteQuery){

            redirect('users.php', 'User/Admin Deleted Successfully');
        }else{
            redirect('users.php', 'Something Went Wrong');
        }

    }else{
        redirect('users.php', $user['message']);
    }

    
}else{
    redirect('users.php', $parameter);
}
?>