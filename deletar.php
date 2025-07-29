<?php include 'conexao.php'; ?>
<?php
$id = $_GET["id"];
$conn->query("DELETE FROM pokemons WHERE id=$id");
header("Location: listar.php");
?>