<?php 
 $servername = "127.0.0.1";
 $username = "root";
 $password = "";
 $dbname = "php";
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

     Password VARCHAR(255) NOT NULL
 )";
 
 

 if ($con->query($sql) === false) {
     echo "Error creating table: " . $con->error;
 } 


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