
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Login</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">
            <?php 
            session_start();
             
              include("php/connect.php");
              if(isset($_POST['submit'])){
                $email = mysqli_real_escape_string($con,$_POST['email']);
                $password = mysqli_real_escape_string($con,$_POST['password']);

                $result = mysqli_query($con,"SELECT * FROM users WHERE Email='$email' AND Password='$password' ") or die("Select Error");
                $row = mysqli_fetch_assoc($result);
                
                if(is_array($row) && !empty($row)){
                    $_SESSION['valid'] = $row['Email'];
                    $_SESSION['firstName'] = $row['FirstName'];
                    $_SESSION['lastName'] = $row['LastName'];
                    $_SESSION['id'] = $row['id'];
                }else{
                    echo "<div class='message'>
                      <p>Wrong Email or Password</p>
                       </div> <br>";
                   echo "<a href='LoginIndex.php'><button class='btn'>Go Back</button>";
         
                }
                if(isset($_SESSION['id'])){
                    header("Location: home.php");
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
                    Don't have account? <a href="register.php">Sign Up</a><br>
                    <a href="ForgotPasword.php" >Forgot Password?</a>
                </div>
            </form>
            
        </div>
        <?php } ?>
      </div>
</body>
</html>