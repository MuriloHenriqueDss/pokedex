<?php include 'conexao.php'; ?>
<?php
$id = $_GET["id"];
$dados = $conn->query("SELECT * FROM pokemons WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $tipo = $_POST["tipo"];
    $local = $_POST["localizacao"];
    $data = $_POST["data_registro"];
    $hp = (int) $_POST["hp"];
    $ataque = (int) $_POST["ataque"];
    $defesa = (int) $_POST["defesa"];
    $obs = $_POST["observacoes"];

    $conn->query("UPDATE pokemons SET nome='$nome', tipo='$tipo', localizacao='$local', data_registro='$data', hp=$hp, ataque=$ataque, defesa=$defesa, observacoes='$obs' WHERE id=$id");
    echo "Atualizado com sucesso! <a href='listar.php'>Voltar</a>";
    exit;
}
?>
<link rel="stylesheet" href="./uploads/css/style.css">
<form method="post">
    Nome: <input type="text" name="nome" value="<?= $dados['nome'] ?>"><br>
    Tipo: <input type="text" name="tipo" value="<?= $dados['tipo'] ?>"><br>
    Localização: <input type="text" name="localizacao" value="<?= $dados['localizacao'] ?>"><br>
    Data: <input type="date" name="data_registro" value="<?= $dados['data_registro'] ?>"><br>
    HP: <input type="number" name="hp" value="<?= $dados['hp'] ?>"><br>
    Ataque: <input type="number" name="ataque" value="<?= $dados['ataque'] ?>"><br>
    Defesa: <input type="number" name="defesa" value="<?= $dados['defesa'] ?>"><br>
    Observações: <textarea name="observacoes"><?= $dados['observacoes'] ?></textarea><br>
    <input type="submit" value="Salvar">
</form>

/* === deletar.php === */
<?php include 'conexao.php'; ?>
<?php
$id = $_GET["id"];
$conn->query("DELETE FROM pokemons WHERE id=$id");
header("Location: listar.php");
?>