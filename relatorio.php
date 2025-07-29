<?php include 'conexao.php'; ?>
<link rel="stylesheet" href="./uploads/css/style.css">
<h1>Relatório de Tipos</h1>
<?php
$sql = "SELECT tipo, COUNT(*) as total FROM pokemons GROUP BY tipo ORDER BY total DESC";
$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
    echo "<strong>Tipo:</strong> " . $row["tipo"] . " - <strong>Total:</strong> " . $row["total"] . "<br>";
}
?>