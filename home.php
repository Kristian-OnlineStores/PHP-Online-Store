<?php
 session_start();
 include("php/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
<style>

     table {
        text-align: center; 
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
             margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            background-color: white;
        }

        th {
            background-color: #f2f2f2;
        }

    </style>

<!-- <script>
function onClick(this) {
    console.log("Clicked on image");
  var modalImg = document.getElementById("modalImg");
  modalImg.src = element.src;
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}
</script> -->

</head> 

 <?php 
   if(!isset($_SESSION['id'])){
    header("Location: LoginIndex.php");
   }
 

$id = $_SESSION['id'];

$query = $con->prepare(" SELECT * FROM users WHERE id = ? ");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if (!$result) {
    die("Select Error: " . $con->error);
}

while ($row = $result->fetch_assoc()) {
    $res_FirstName = $row['FirstName'];
    $res_LastName = $row['LastName'];
    $res_Email = $row['Email'];

    $res_id = $row['id'];
}

$query->close();
$result->free_result();
?>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php"><img src="img/Logo.png" alt="No img" width="60" height="50"></a> </p>
  
        </div>
        

        <div class="right-links">
            <a href="cart.php"><button class="btn">Cart </button></a> 

<a href="complain.php"> <button class="btn">Complain</button></a>


        <div class="dropdown">
            <button class="dropbtn"> <b><?php echo $res_FirstName . ' ' . $res_LastName; ?></b></button>
            <div class="dropdown-content">
                <a href="update.php?Id=<?php echo $res_id; ?>">Update Profile</a>
                <a href="php/logout.php">Log Out</a>
            </div>
        </div>

        </div>
    </div>
    <h1 style="text-align: center; margin-top: 20px;">Catalog with cars</h1>

    <?php

include("php/connect.php");

if(!isset($_SESSION['valid'])){
 header("Location: LoginIndex.php");
}


$sql = "SELECT * FROM cars";
$result = $con->query($sql);


echo "<table border='0''>
        <tr>

            <th>Brand</th>
            <th>Model</th>
            
            <th>Year</th>
            <th>Price</th>
        </tr>";

while ($row = $result->fetch_assoc()) {
    $imagePath = "img/{$row['model']}.jpg";
    echo "<tr>

            <td>{$row['brand']}</td>
            <td>  <div'>
            {$row['model']} 
            
            <img src='{$imagePath}' alt='{$row['brand']} {$row['model']}' width='100' style='margin-left: 10px' onclick='onClick(this)'>
            </div>
            </td>

            <td>{$row['year']}</td>
            
             <td>" . number_format($row['price'], 2) . " lv
             
             </td>
            <td>
                <a href='cart.php?action=add&id={$row['id']}' class='btn'>Add to Cart</a>
            </td>
            
            </tr>";
}
echo "</table>";


$con->close();
?>

</body>
</html>
<!--<td>{$row['price']}</td>-->