<?php
require 'config/function.php';


//require_once __DIR__ . '/config/function.php';

if (isset($_POST['saveUser'])) 
    {
        $FirstName = validate( $_POST['firstname']);
        $LastName = validate($_POST['lastname']);
        $Email = validate($_POST['email']);
        $Password = validate($_POST['password']);
        $PasswordHSH = password_hash($Password, PASSWORD_DEFAULT);

        $Role = validate($_POST['role']);
        $IsBan = validate($_POST['is_ban']) ? 1 : 0;
    

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


    if($FirstName != '' && $LastName != '' && $Email != '' && $Password != '') 
    {

   if (!empty($Password)) {
    // If a new password is provided
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
    // If no new password is provided, keep the existing password
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

?>