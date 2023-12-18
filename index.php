<?php 

declare(strict_types=1);

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


$sql = "SELECT * FROM car ORDER BY prijs ASC";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll();


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    <h3>De duurste auto's ter wereld</h3>

    <table>
        <thead>
            <th>Merk</th>
            <th>Model</th>
            <th>Topsnelheid</th>
            <th>Prijs</th>  
        </thead>
        <tbody>
        <?php foreach($result as $car): ?>
            <tr>
                <td><?= htmlspecialchars($car['merk']); ?></td>
                <td><?= htmlspecialchars($car['model']); ?></td>
                <td><?= $car['topsnelheid']; ?> km/ph</td>
                <td>€ <?= $car['prijs']; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Voeg een auto toe</h2>

    <form method="post" action="create.php">
        <label for="brand">Merk: </label>
        <input type="text" name="brand" id="brand">

        <label for="model">Model: </label>
        <input type="text" name="model" id="model"

        <label for="topspeed">Topsnelheid:</label>
        <input type="text" name="topspeed" id="topspeed">

        <label for="price">Prijs: </label>
        <input type="text" name="price" id="price">

        <input type="submit" value="Verzend" name="submit">
    </form>
</body>
</html>