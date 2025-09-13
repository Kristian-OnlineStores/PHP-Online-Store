<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Register</title>
</head>
<body>
      <div class="container">
        <div class="box form-box">

        <?php 
         
         include("php/connect.php");
         if(isset($_POST['submit'])){
            $firstname = $_POST['firstName'];
            $lastname = $_POST['lastName'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST["confirmPassword"];

            
            if ($password!=$confirmPassword) {
    echo "<div class='message'>
                  <p>Passwords do not match, please try again.</p>
              </div> <br>";
        echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
}else{
         $verify_query = mysqli_query($con,"SELECT Email FROM users WHERE Email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){
            echo "<div class='message'>
                      <p>This email is used, Try another One Please!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Go Back</button>";
         }
         else{

            mysqli_query($con," INSERT INTO users( FirstName, LastName, Email, Password) VALUES('$firstname', '$lastname', '$email', '$password')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Registration successfully!</p>
                  </div> <br>";
            echo "<a href='LoginIndex.php'><button class='btn'>Login Now</button>";
         

         }
}
         }else{
         
        ?>

            <header>Sign Up</header>
            <form action="" method="post">

            <div class="field input">      
                <input type="text" name="firstName" class="forma" placeholder="FirstName" size="30" autocomplete="off" required>
            </div >
            
            <div  class="field input">
                <input type="text" name="lastName" class="forma" placeholder="LastName" size="30" autocomplete="off" required>
            </div >

            <div class="field input">
                <input type="email" name="email" id="email" placeholder="Email" autocomplete="off" required>
            </div>

            <div class="field input">
                <input type="password" name="password" id="password" placeholder="Password" autocomplete="off" required>
            </div>

            <div class="field input">
                <input type="password" name="confirmPassword" class="forma" placeholder="ConfirmPassword" size="30" autocomplete="off" required>
            </div>

            <div class="field">
                <input type="submit" class="btn" name="submit" value="Register" required>
            </div>
                <div class="links">
                    Already a member? <a href="LoginIndex.php">Sign In</a>
                </div>
            </form>
        </div>
        <?php } ?>
      </div>
</body>
</html>