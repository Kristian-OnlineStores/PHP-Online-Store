<?php 
   session_start();

   include("../php/Connect/connect.php");
   include("../header.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Update Profile</title>
</head>
<body>

    <div class="container">
        <div class="box form-box">
            <?php 
               if(isset($_POST['submit'])){
                
                $firstName = $_POST['firstName'];
                $lastName = $_POST['lastName'];
                $email = $_POST['email'];
                

                $id = $_SESSION['id'];

                $edit_query = mysqli_query($con,"UPDATE users SET FirstName='$firstName', LastName='$lastName',Email='$email' WHERE Id=$id ") or die("error occurred");

                if($edit_query){
                    echo "<div class='message'>
                    <p>Profile Updated!</p>
                </div> <br>";
              echo "<a href='../home.php'><button class='btn'>Go Home</button>";
       
                }
               }else{

                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE Id=$id ");

                while($result = mysqli_fetch_assoc($query)){
                    $res_firstName = $result['FirstName'];
                    $res_lastName = $result['LastName'];
                    $res_Email = $result['Email'];
                   
                }

            ?>
            <header>Update Profile</header>
            <form action="" method="post">
                <div class="field input">
                    
                    <input type="text" name="firstName" id="firstName" value="<?php echo $res_firstName; ?>" placeholder="FirstName" autocomplete="off" required>
                </div>

                <div class="field input">
                    
                    <input type="text" name="lastName" id="lastName" value="<?php echo $res_lastName; ?>" placeholder="LastName" autocomplete="off" required>
                </div>

                <div class="field input">
                    
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" placeholder="Email" autocomplete="off" required>
                </div>

                
                
                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value="Update" required>
                </div>
                
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>