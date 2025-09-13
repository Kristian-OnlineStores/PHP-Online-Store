
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
<?php
session_start();

include("php/connect.php");

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);

    $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email'") or die("Select Error");
    $row = mysqli_fetch_assoc($result);

    if (is_array($row) && !empty($row)) {
      

        echo "<div class='message'>
                <p>Request sent to email.</p>
              </div> <br>";
              echo "<a href='LoginIndex.php'><button class='btn'>Go Back</button>";
    } else {
        echo "<div class='message'>
                <p>No user found with that email.</p>
              </div> <br>";
              echo "<a href='ForgotPasword.php'><button class='btn'>Go Back</button>";
    }
}else{
?>
    
            <header>Forgot Password</header>
            <form action="" method="post">
                <div class="field input">
                    <input type="text" name="email" id="email" placeholder="Email" autocomplete="off" required>
                </div>

                <div class="field">
                    <input type="submit" class="btn" name="submit" value="Reset Password" required>
                </div>
            </form>
        </div>
       <?php } ?> 
    </div>
    
</body>
</html>
