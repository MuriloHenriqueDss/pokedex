<?php include 'conexao.php'; ?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conn->real_escape_string($_POST["nome"]);
    $tipo = $conn->real_escape_string($_POST["tipo"]);
    $local = $conn->real_escape_string($_POST["localizacao"]);
    $data = $conn->real_escape_string($_POST["data_registro"]);
    $hp = (int) $_POST["hp"];
    $ataque = (int) $_POST["ataque"];
    $defesa = (int) $_POST["defesa"];
    $obs = $conn->real_escape_string($_POST["observacoes"]);
    
    $foto = "";
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $foto = "uploads/img/" . uniqid() . "." . $ext;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
    }

    if ($nome != "") {
        $sql = "INSERT INTO pokemons (nome, tipo, localizacao, data_registro, hp, ataque, defesa, observacoes, foto)
                VALUES ('$nome', '$tipo', '$local', '$data', $hp, $ataque, $defesa, '$obs', '$foto')";
        $conn->query($sql);
        echo "Pokémon cadastrado com sucesso!";
    } else {
        echo "Nome é obrigatório!";
    }
}
?>
<link rel="stylesheet" href="./uploads/css/cadastrar.css">
<a href="index.php" class="btn-voltar"> Voltar</a>
<div class="cadastro-container">
  <h2>Cadastro <br><br> Pokémon Perdido</h2>
  <form method="post" enctype="multipart/form-data">
    <label>Nome:</label>
    <input type="text" name="nome" required>
    <label>Tipo:</label>
    <input type="text" name="tipo">
    <label>Localização:</label>
    <input type="text" name="localizacao">
    <label>Data de Registro:</label>
    <input type="date" name="data_registro">
    <label>HP:</label>
    <input type="number" name="hp">
    <label>Ataque:</label>
    <input type="number" name="ataque">
    <label>Defesa:</label>
    <input type="number" name="defesa">
    <label>Observações:</label>
    <textarea name="observacoes"></textarea>
    <label>Foto:</label>
    <input type="file" name="foto">
    <input type="submit" value="Cadastrar">
  </form>
</div>