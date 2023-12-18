<?php 

declare(strict_types=1);

if($_SERVER['REQUEST_METHOD'] !== 'POST')
return;

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "crud-php-pdo-opdracht";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
} catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
}


$sql = "INSERT INTO car (merk, model, topsnelheid, prijs) VALUES (:brand, :model, :topspeed, :price)";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':brand', $_POST['brand'], PDO::PARAM_STR);
$stmt->bindParam(':model', $_POST['model'], PDO::PARAM_STR);
$stmt->bindParam(':topspeed', $_POST['topspeed'], PDO::PARAM_INT);
$stmt->bindParam(':price', $_POST['price'], PDO::PARAM_INT);

if($stmt->execute()) {
  echo $_POST['brand']  . ' ' . $_POST['model'] . ' ' . 'has been inserted';
  header('Refresh:3.5; url=index.php');
}

