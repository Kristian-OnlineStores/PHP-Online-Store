<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "php";
$port = "3310";

$con = new mysqli($servername, $username, $password, $dbname, $port);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS 
    complaint (
        id INT PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        mesege TEXT NOT NULL
    )";

if ($con->query($sql) === false) {
    echo "Error creating table: " . $con->error;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $con->real_escape_string($_POST['name']);
    $email = $con->real_escape_string($_POST['email']);
    $mesege = $con->real_escape_string($_POST['mesege']);

    $query = "INSERT INTO complaint (name, email, mesege) VALUES ('$user', '$email', '$mesege')";

    if ($con->query($query) === false) {
        echo "Error: " . $con->error;
    } else {

        header("Location: home.php");
        exit;
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
    <script>
        function clearMessage(){
            document.getElementById('mesege').value = '';
        }

        function goToHomePage() {
            window.location.href = 'home.php';
        }
    </script>
</head>
<body>

<?php 
   session_start();

   include("php/connect.php");
   if(!isset($_SESSION['valid'])){
    header("Location: LoginIndex.php");
   }
   $id = $_SESSION['id'];

   $query = $con->prepare("SELECT * FROM users WHERE id = ?");
   $query->bind_param("i", $id);
   $query->execute();
   $result = $query->get_result();
 
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

    <div class="container">
        <div class="box form-box">
        <header>Complain</header>
            <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="field input">
                    <input type="text" id="name" name="name" placeholder="Name" required>
                </div>

                <div class="field input">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>

                <div class="field input">
                    <textarea id="mesege" name="mesege" rows="4" style="border-radius: 15px;     padding: 8px;    border: 1px solid #ccc; " placeholder="Message" required></textarea>
                </div>

                <div class="field">
                    <button class="btn" type="submit">Submit</button>
                    <button class="btn" type="button" onclick="clearMessage()">Clear</button>
                    <button class="btn" type="button" onclick="goToHomePage()">Go back</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
