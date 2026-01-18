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

        header("Location: ../home.php");
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
    <link rel="stylesheet" href="../assets/style/style.css">
    <title>Document</title>
    <script>
        function clearMessage(){
            document.getElementById('mesege').value = '';
        }

        function goToHomePage() {
            window.location.href = '../home.php';
        }
    </script>
</head>
<body>

<?php 
   session_start();

   include("../php/Connect/connect.php");
   include("../header.php");

 ?>

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
