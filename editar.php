<?php include 'conexao.php'; ?>
<?php
$id = $_GET["id"];
$dados = $conn->query("SELECT * FROM pokemons WHERE id=$id")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $conn->real_escape_string($_POST["nome"]);
    $tipo = $conn->real_escape_string($_POST["tipo"]);
    $local = $conn->real_escape_string($_POST["localizacao"]);
    $data = $conn->real_escape_string($_POST["data_registro"]);
    $hp = (int) $_POST["hp"];
    $ataque = (int) $_POST["ataque"];
    $defesa = (int) $_POST["defesa"];
    $obs = $conn->real_escape_string($_POST["observacoes"]);
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Atualizado com sucesso!',
                text: 'O Pokémon foi atualizado.',
                confirmButtonColor: '#3b4cca'
            }).then(() => {
                window.location.href = 'listar.php';
            });
        });
    </script>";

    $foto = $dados['foto']; // mantém a imagem antiga por padrão

    // Verifica se foi enviada uma nova imagem
    if (isset($_FILES["foto"]) && $_FILES["foto"]["error"] == 0) {
        if (!empty($foto) && file_exists($foto)) {
            unlink($foto);
        }

        $ext = pathinfo($_FILES["foto"]["name"], PATHINFO_EXTENSION);
        $foto = "uploads/img/" . uniqid() . "." . $ext;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $foto);
    }

    $sql = "UPDATE pokemons SET 
                nome='$nome', 
                tipo='$tipo', 
                localizacao='$local', 
                data_registro='$data', 
                hp=$hp, 
                ataque=$ataque, 
                defesa=$defesa, 
                observacoes='$obs', 
                foto='$foto'
            WHERE id=$id";

    $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Pokémon</title>
    <link rel="stylesheet" href="./uploads/css/estilo-editar.css">
</head>
<body>

<div class="pokeball-bg">
  <div class="pokeball"></div>
  <div class="pokeball"></div>
  <div class="pokeball"></div>
  <div class="pokeball"></div>
</div>

<div class="editar-container">
  <h2>Editar Pokémon</h2>
  <form method="post" enctype="multipart/form-data">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($dados['nome']) ?>" required>

    <label>Tipo:</label>
    <input type="text" name="tipo" value="<?= htmlspecialchars($dados['tipo']) ?>">

    <label>Localização:</label>
    <input type="text" name="localizacao" value="<?= htmlspecialchars($dados['localizacao']) ?>">

    <label>Data de Registro:</label>
    <input type="date" name="data_registro" value="<?= $dados['data_registro'] ?>">

    <label>HP:</label>
    <input type="number" name="hp" value="<?= $dados['hp'] ?>">

    <label>Ataque:</label>
    <input type="number" name="ataque" value="<?= $dados['ataque'] ?>">

    <label>Defesa:</label>
    <input type="number" name="defesa" value="<?= $dados['defesa'] ?>">

    <label>Observações:</label>
    <textarea name="observacoes"><?= htmlspecialchars($dados['observacoes']) ?></textarea>

    <label>Foto atual:</label><br>
    <?php if (!empty($dados['foto']) && file_exists($dados['foto'])): ?>
      <img src="<?= htmlspecialchars($dados['foto']) ?>" alt="Foto do Pokémon" class="imagem-preview"><br><br>
    <?php else: ?>
      <em>Nenhuma imagem cadastrada ou caminho inválido.</em><br><br>
    <?php endif; ?>

    <label>Nova Foto (opcional):</label>
    <input type="file" name="foto"><br><br>

    <input type="submit" value="Salvar">
  </form>
</div>

<style>
  .imagem-preview {
    width: 150px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    margin: 10px 0;
  }
</style>

</body>
</html>
