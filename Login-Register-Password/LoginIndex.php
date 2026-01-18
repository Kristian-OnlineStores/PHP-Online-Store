
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
            session_start();
             
              include("../php/Connect/connect.php");
              if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($con,$_POST['email']);
                //$password = mysqli_real_escape_string($con,$_POST['password']);
                $password = $_POST['password'];
                $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);
                

                if(is_array($row) && !empty($row)){

                 if ($row['IsBan'] == 1) {
    echo "<div class='message'>
                    <p>Your account has been banned. Please contact support for more information.</p>
                  </div><br>
                  <a href='../Login-Register-Password/LoginIndex.php'><button class='btn'>Go Back</button></a>";  
exit();
                  } 

            if (password_verify($password, $row['Password'])) 
          {
            $_SESSION['id'] = $row['id'];
            $_SESSION['valid'] = $row['Email'];
            $_SESSION['firstName'] = $row['FirstName'];
            $_SESSION['lastName'] = $row['LastName'];
            $_SESSION['role'] = $row['Role'];
            $_SESSION['isBan'] = $row['IsBan'];
            
           
            $user_id = $row['id'];
            $cart_query = $con->prepare("Select * From cart Where user_id = ?");
            $cart_query->bind_param("i",$user_id);
            $cart_query->execute();
            $cart_result = $cart_query->get_result();
            
            $_SESSION['cart'] = array();
            while($cart_item = $cart_result->fetch_assoc()){
              $_SESSION['cart'] [$cart_item['id']] = array(
                'brand' => $cart_item['brand'],
                'model' => $cart_item['model'],
                'price' => $cart_item['price'],
                'quantity' => $cart_item['quantity']
              );
            }
            $cart_query->close();
          


 if ($row['Role'] == 'admin') {
               header("Location: ../Admin/index.php");
                    exit();
            }else{
            header("Location: ../home.php");
            exit();
          } 



        } else {
            echo "<div class='message'>
                    <p>Wrong password</p>
                  </div><br>
                  <a href='../Login-Register-Password/LoginIndex.php'><button class='btn'>Go Back</button></a>";
        }
                }else{
                    echo "<div class='message'>
                      <p>Wrong Email</p>
                       </div> <br>";
                   echo "<a href='../Login-Register-Password/LoginIndex.php'><button class='btn'>Go Back</button></a>";
         
                }
                if(isset($_SESSION['id'])){
                    header("Location: ../home.php");
                    exit();
                }
              }else{

            
            ?>
            <header>Sign In</header>
            <form action="" method="post">
                <div class="field input">
                    <input type="text" name="email" id="email" placeholder=" Email" autocomplete="off" required>
                </div>

                <div class="field input">
                    <input type="password" name="password" id="password" placeholder=" Password" autocomplete="off" required>
                </div>

                <div class="field">
                    
                    <input type="submit" class="btn" name="submit" value=" Login" required>
                </div>
                <div class="links">
                    Don't have account? <a href="../Login-Register-Password/Register.php">Sign Up</a><br>
                    <a href="../Login-Register-Password/ForgotPasword.php" >Forgot Password?</a>
                </div>
            </form>
            
        </div>
        <?php } ?>
      </div>
</body>
</html>