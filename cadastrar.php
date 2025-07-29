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
        $foto = "uploads/" . uniqid() . "." . $ext;
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

<form method="post" enctype="multipart/form-data">
    Nome: <input type="text" name="nome" required><br>
    Tipo: <input type="text" name="tipo"><br>
    Localização: <input type="text" name="localizacao"><br>
    Data de Registro: <input type="date" name="data_registro"><br>
    HP: <input type="number" name="hp"><br>
    Ataque: <input type="number" name="ataque"><br>
    Defesa: <input type="number" name="defesa"><br>
    Observações: <textarea name="observacoes"></textarea><br>
    Foto: <input type="file" name="foto"><br>
    <input type="submit" value="Cadastrar">
</form>
