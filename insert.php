<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Toevoegen</title>
</head>
<body>
<?php
$host = 'localhost:3307';
$db   = 'winkel';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try 
{
     $pdo = new PDO($dsn, $user, $pass, $options); 
     echo "Connected to Winkel";
}
catch (\PDOException $e) 
{
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productnaam = $_POST["product_naam"];
    $prijsperstuk = $_POST["prijs_per_stuk"];
    $omschrijving = $_POST["omschrijving"];

    $sql = "INSERT INTO producten (product_naam, prijs_per_stuk, omschrijving)
    VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $gegevenVanFormulier = array($productnaam, $prijsperstuk, $omschrijving);

    $stmt->execute($gegevenVanFormulier);
}
?>
<h2>Product Toevoegen</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <label for="product_naam">Product Naam:</label>
    <input type="text" name="product_naam" required><br><br>

    <label for="prijs_per_stuk">Prijs per stuk:</label>
    <input type="number" name="prijs_per_stuk" step="0.01" required><br><br>

    <label for="omschrijving">Omschrijving:</label>
    <textarea name="omschrijving" required></textarea><br><br>

    <input type="submit" value="Product Toevoegen">
</form>
</body>
</html>
