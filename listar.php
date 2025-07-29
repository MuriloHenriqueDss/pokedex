<?php include 'conexao.php'; ?>

<link rel="stylesheet" href="./uploads/css/style.css">
<h1>Lista de Pokémons Encontrados</h1>
<?php
$result = $conn->query("SELECT * FROM pokemons");

while ($row = $result->fetch_assoc()) {
    echo "<hr>";
    echo "<strong>Nome:</strong> " . $row["nome"] . "<br>";
    echo "<strong>Tipo:</strong> " . $row["tipo"] . "<br>";
    echo "<strong>Localização:</strong> " . $row["localizacao"] . "<br>";
    echo "<strong>Data:</strong> " . $row["data_registro"] . "<br>";
    echo "<strong>HP:</strong> " . $row["hp"] . " | ";
    echo "<strong>Ataque:</strong> " . $row["ataque"] . " | ";
    echo "<strong>Defesa:</strong> " . $row["defesa"] . "<br>";
    echo "<strong>Observações:</strong> " . $row["observacoes"] . "<br>";
    if ($row["foto"]) {
        echo "<img src='" . $row["foto"] . "' width='150'><br>";
    }
    echo "<a href='editar.php?id=" . $row["id"] . "'>Editar</a> | ";
    echo "<a href='deletar.php?id=" . $row["id"] . "' onclick='return confirm(\"Deseja excluir?\")'>Excluir</a>";
}
?>
