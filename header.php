<?php
//session_start();
 include("php/Connect/connect.php");

if (!isset($_SESSION['id'])) {
    // If the user is not logged in, redirect to the login page
    header("Location: ../Login-Register-Password/LoginIndex.php");
    exit();
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


     <div class="nav">
        <div class="logo">
            <p><a href="../home.php"><img src="../assets/img/Logo.png" alt="No img" width="60" height="50"></a> </p>
  
        </div>
        

        <div class="right-links">
            <a href="../home.php"><button class="btn">Home </button></a> 
            <a href="../php/cart.php"><button class="btn">Cart </button></a> 
            <a href="../php/complain.php"> <button class="btn">Complain</button></a>


        <div class="dropdown">
            <button class="dropbtn"> <b><?php echo $res_FirstName . ' ' . $res_LastName; ?></b></button>
            <div class="dropdown-content">
                <a href="../php/update.php?Id=<?php echo $res_id; ?>">Update Profile</a>
                <a href="../php/logout.php">Log Out</a>
            </div>
        </div>

        </div>
    </div>
<!--<a href="home.php"><button class="btn">Continue Shopping</button></a>-->
   
