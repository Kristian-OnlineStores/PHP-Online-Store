 <? session_start();
  include("php/Connect/connect.php");
 require 'php/config/function.php';

 $currentPage = basename($_SERVER['PHP_SELF']);

 checkIfAlreadyLoggedIn();

 $user = getCurrentUser($con);

 $res_FirstName = $user['FirstName'] ?? '';
 $res_LastName = $user['LastName'] ?? '';
 $res_Email = $user['Email'] ?? '';
 $res_id = $user['id'] ?? '';
 ?>
 
 <nav class="nav stick-top">
        <div class="logo">
            <p><a href="../home.php"><img src="../assets/img/Logo.png" alt="No img" width="60" height="50"></a> </p>
  
        </div>
        

        <div class="right-links">
            <a href="../home.php"><button class="btn">Home </button></a> 
            
            <a href="../php/complain.php"> <button class="btn">Complain</button></a>


        <div class="dropdown">
            <button class="drop-btn"> <b><?php echo $res_FirstName . ' ' . $res_LastName; ?></b></button>
            <div class="dropdown-content">
                <a href="../php/update.php?Id=<?php echo $res_id; ?>">Update Profile</a>
                <a href="../php/logout.php">Log Out</a>
            </div>
        </div>

        <a href="../php/cart.php"><button class="btn">Cart </button></a> 
        </div>
</nav>