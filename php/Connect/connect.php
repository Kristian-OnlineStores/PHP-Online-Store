<?php 
 $servername = "127.0.0.1";
 $username = "root";
 $password = "";
 $dbname = "php-online store";
 $port="3310";

 $con = new mysqli($servername, $username, $password, $dbname,$port);
 

 if ($con->connect_error) {
     die("Connection failed: " . $con->connect_error);
 }
 
 
 $sql = "CREATE TABLE IF NOT EXISTS users (
     id INT AUTO_INCREMENT PRIMARY KEY,
     
     FirstName VARCHAR(255) NOT NULL,
     LastName VARCHAR(255) NOT NULL,
     Email VARCHAR(255) NOT NULL,
     Password VARCHAR(255) NOT NULL,
     IsBan TINYINT(1) DEFAULT 0,
     Role /*ENUM('user','admin') Default 'user',*/VARCHAR(255) NOT NULL,
     CreatedAT TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     

 )";
 if ($con->query($sql) === false) {
     echo "Error creating table: " . $con->error;
 } 

/*$admin_email = "Admin@admin.com";
$admin_password = password_hash("adMiN", PASSWORD_DEFAULT);
$admin_firstname = "K";
$admin_lastname = "M";

$check_admin = $con->prepare("SELECT id FROM users WHERE Email = ?");
$check_admin->bind_param("s", $admin_email);
$check_admin->execute();
$check_admin->store_result();

if ($check_admin->num_rows == 0) {
    $create_admin = $con->prepare("INSERT INTO users (FirstName, LastName, Email, Password, Role) VALUES (?, ?, ?, ?, 'admin')");
    $create_admin->bind_param("ssss", $admin_firstname, $admin_lastname, $admin_email, $admin_password);
    
    if ($create_admin->execute()) {
        error_log(" Administrator account created:  $admin_email / admin");
    } else {
        error_log(" Error creating administrator: " . $con->error);
    }
    $create_admin->close();
}

$check_admin->close();*/

$sql ="CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    brand VARCHAR(255) NOT NULL,
    model VARCHAR(255) NOT NULL,   
    year INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL
)";
if ($con->query($sql) === false) {
    echo "Error creating table: " . $con->error;
} 

$sql ="CREATE TABLE IF NOT EXISTS cart (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
    FOREIGN KEY (product_id) REFERENCES cars(id) ON DELETE SET NULL,
    UNIQUE KEY unique_user_product (user_id, product_id)
)";
if ($con->query($sql) === false) {
    echo "Error creating table: " . $con->error;
} 

$sql = "CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total DECIMAL(10,2),
    payment_method VARCHAR(50),
    card_name VARCHAR(255),
    card_number VARCHAR(20),
    card_expiry VARCHAR(10),
    card_cvv VARCHAR(5),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
)";
if ($con->query($sql) === false) {
    echo "Error creating table: " . $con->error;
} 

$checkIfExistsQuery = "SELECT * FROM cars";
$result = $con->query($checkIfExistsQuery);

if ($result->num_rows === 0) {
    
    $insertQuery = "INSERT INTO cars (brand, model,  year, price) VALUES
    ('Ford', 'Mustang', 2022, 45000.00),
    ('Dacia', 'Duster', 2020, 35720.00),
    ('Honda', 'Civic', 2023, 23000.00),
    ('Toyota', 'Corolla', 2022, 25500.00)"; 
    
    
    if ($con->query($insertQuery) === false) {
        echo "Error inserting data: " . $con->error;
    } 
} 



?>