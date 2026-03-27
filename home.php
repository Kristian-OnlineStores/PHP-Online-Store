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


$sql = "SELECT * FROM goods";
$result = $con->query($sql);
    


while ($row = $result->fetch_assoc()) {
    
    $imagePath = "assets/img/Cars/{$row['model']}.jpg";

    $final_price = $row['price'];
        if($row['saleStatus'] == 1 && $row['discountPercent'] > 0) {
            $final_price = $row['price'] - ($row['price'] * $row['discountPercent'] / 100);
        } 
        ?>
     <div class='cars-conntent' style="position: relative;">
        <?php if($row['saleStatus'] == 1 && $row['discountPercent'] > 0): ?>
            <div style="position: absolute; top: 0; left: 0; width: 0; height: 0; border-top: 80px solid red; border-right: 80px solid transparent; z-index: 10;">
            <span style="position: absolute; top: -70px; left: 5px; color: white; font-weight: bold; transform: rotate(-45deg);">-<?= $row['discountPercent']; ?>%</span>
        </div>
        <?php endif; ?>

        <div class='car-model'> 
            <?= $row['brand'] . ' ' . $row['model']; ?>
        </div>
        
        <div class='car-price'>
            <?php if($row['saleStatus'] == 1 && $row['discountPercent'] > 0): ?>
                <small class="text-muted"><del>€<?= number_format($row['price'], 2); ?></del></small>
                <br>
                <strong class="">€<?= number_format($final_price, 2); ?></strong>
                <br>
            <?php else: ?>
                €<?= number_format($row['price'], 2); ?>
            <?php endif; ?>
        </div>
        
        <img src='<?= $imagePath; ?>' alt='<?= $row['brand'] . ' ' . $row['model']; ?>' width='300' style='margin-left: 10px'>
        
        <div class='buttons'>
            <a href='.php?action=add&id=<?= $row['id']; ?>' class='btn'>Learn More</a>
        </div>
        
        <div class='buttons'>
            <a href='php/cart.php?action=add&id=<?= $row['id']; ?>' class='btn'>Add to Cart</a>
        </div>
    </div>
    
    <?php
    }
    $con->close();
    ?>
    
</div>

   

</body>
</html>
<!--<td>{$row['price']}</td>-->