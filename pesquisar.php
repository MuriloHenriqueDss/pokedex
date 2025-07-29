<?php include 'conexao.php'; ?>

<form method="get">
    Buscar por nome: <input type="text" name="q">
    <input type="submit" value="Pesquisar">
</form>

<?php
if (isset($_GET["q"])) {
    $q = $conn->real_escape_string($_GET["q"]);
    $sql = "SELECT * FROM pokemons WHERE nome LIKE '%$q%'";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<hr>";
        echo "<strong>Nome:</strong> " . $row["nome"] . "<br>";
        echo "<strong>Tipo:</strong> " . $row["tipo"] . "<br>";
    }
}
?>
