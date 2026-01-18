<?php
 session_start();
// include("php/connect.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/style/style.css">
    <title>Home</title>
<style>

.cars-container{
display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
    padding: 0 0px;
    margin: 20px;
    justify-items: center;
    margin: 0;
}

.cars-conntent{
    border: 1px solid #ccc;
    background-color: white;
    border-radius: 10px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
    </style><A></A>

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

 <?php include("header.php");
   /*if(!isset($_SESSION['id'])){
    header("Location: header.php");
    exit();
   }*/
?>
<body>
    <h1 style="text-align: center; margin-top: 20px;">Catalog with cars</h1>

<div class="cars-container" >
 <?php


$sql = "SELECT * FROM cars";
$result = $con->query($sql);



while ($row = $result->fetch_assoc()) {
    
    $imagePath = "assets/img/Cars/{$row['model']}.jpg";
    $price_euro = number_format($row['price'] / 1.95583, 2, ',', ' ');
    $price_leva = number_format($row['price'], 0, ',', ' ');
    echo "
    <div class='cars-conntent'>
           <div class='car-model'> 
           {$row['brand']}  {$row['model']} 
            </div>
            
            <div class='car-price'>  $price_leva lv. / $price_euro €</div>
            <div class='car-price-euro'></div>
            
            <img src='{$imagePath}' alt='{$row['brand']} {$row['model']}' width='300' style='margin-left: 10px' onclick='onClick(this)'>
            


            
            
            <div class='buttons'><a href='.php?action=add&id={$row['id']}' class='btn'>Lern More</a></div>
              <div class='buttons'><a href='php/cart.php?action=add&id={$row['id']}' class='btn'>Add to Cart</a></div>
   
              </div>
   ";
}
//echo "</table>"; {$row['year']}


$con->close();
?>

</div>

   

</body>
</html>
<!--<td>{$row['price']}</td>-->