<?php
session_start();

//define('BASE_URL', '/PHP-Online Store/Admin/');
//require '../php/Connect/connect.php';
require_once __DIR__ . '/../../php/Connect/connect.php';

function validate($inputData){

    global $con;

    $validatedData = mysqli_real_escape_string($con,$inputData);
    return trim($validatedData);
}

function redirect($url, $status){

    $_SESSION['status'] = $status;
    header("Location: ".$url);
    exit(0);
}
  
function alertMessage(){
    if(isset( $_SESSION['status'])){
        echo '<div class="alert alert-success">
        <h4>'.$_SESSION['status'].'</h4>
        </div>';
        unset($_SESSION['status']);
    }
}

function getAll($tableName){
    global $con;    
    $tableName =validate($tableName);
$query = "SELECT * FROM $tableName";
            $result = mysqli_query($con, $query);
            return $result;
}

function checkParamId($Id){
    if(isset($_GET[$Id])){
        if ($_GET[$Id] != null && $_GET[$Id] != '') {
            return $_GET[$Id];
        }else{
            return 'No id found';
        }
    }else{
        return 'No id given';
    }
}

function getById($tableName, $userId){
    global $con;
    $tableName = validate($tableName);
    $userId = validate($userId);

    $query = "SELECT * FROM $tableName WHERE id='$userId' LIMIT 1";
    $result = mysqli_query($con, $query);


    
    if ($result) {
          if(mysqli_num_rows($result) == 1){
       
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $response = ['status' => 200, 'message' => 'Success','data' => $row];
        return $response;
       
    }else{
        $response = ['status' => 404, 'message' => 'No Data Found'];
        return $response;
    }
    }else{
        $response = ['status' => 500, 'message' => 'Something went wrong'];
        return $response;
    }
  
}

function deleteQuery($tableName, $userId){
    global $con;

    $table = validate($tableName); // Sanitize table name to prevent SQL injection
    $userId = validate($userId); // Sanitize user input to prevent SQL injection

    $query = "DELETE FROM $table WHERE id='$userId' LIMIT 1";
    $result = mysqli_query($con, $query);
    return $result;
}


function getBasePath() {
    $script_path = $_SERVER['SCRIPT_NAME'];
    
    
    if (strpos($script_path, '/Admin/Users/') !== false) {
        return '../';
    }
    
    elseif (preg_match('#/Admin/([^/]+)/#', $script_path, $matches)) {
        $folder = $matches[1];
        if ($folder !== 'index.php' && $folder !== '') {
            return '../';
        }
    }
    
    
    return '';
}

function getCount($tableName) {
    global $con;
    $tableName = validate($tableName);
    $query = "SELECT COUNT(*) AS count FROM $tableName";
    $result = mysqli_query($con, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['count'];
    } else {
        return 0;
    }
}
                            /////////////// Other Functions //////////////////

                        /////////////// Cart Functions //////////////////

                            function getUser($userId) {
    global $con;
    $query = "SELECT id, FirstName, LastName FROM users WHERE id = '$userId'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['id'] . ' - ' . $row['FirstName'] . ' ' . $row['LastName'];
    }else {
    return 'Unknown User';
    }
}

function getProduct($productId) {
    global $con;
    $query = "SELECT id, brand, model FROM goods WHERE id = '$productId'";
    $result = mysqli_query($con, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        return $row['id'] . ' - ' . $row['brand'] . ' ' . $row['model'];
    }else {
    return 'Unknown Product';
    }
}

function getService($serviceId) {
    global $con;

    if ($serviceId == ' ' || $serviceId == 'Select' || $serviceId == 'NULL') {
        return 'No Service Selected';
    }else{
        $serviceId = validate($serviceId); // Sanitize user input to prevent SQL injection
   
    $query = "SELECT id, name FROM services WHERE id = '$serviceId'";
    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row['id'] . ' - ' . $row['name'];
    }else {
    return 'Unknown Service';
    }
    }
}
                            /////////////// Cart Functions //////////////////

                        ///////////////  //////////////////

function webSetting($columName) 
{
    $setting = getById('settings', 1);
    if ($setting['status'] == 200) {
        return  $setting['data'][$columName];
    } else {
        return null;
    }
                        }

?>