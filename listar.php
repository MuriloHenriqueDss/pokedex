<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pokémons</title>
    <link rel="stylesheet" href="./uploads/css/estilo-lista.css">
</head>
<body>
    <link rel="stylesheet" href="./uploads/css/cadastrar.css">
    <div class="pokeball-fundo">
        <div class="pokeball"></div>
        <div class="pokeball"></div>
        <div class="pokeball"></div>
    </div>

    <div class="container-lista">
        <h1 class="titulo">Pokémons Encontrados</h1>

        <?php
        $result = $conn->query("SELECT * FROM pokemons");

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card-pokemon'>";
                echo "<h2>" . htmlspecialchars($row["nome"]) . "</h2>";
                echo "<p><span>Tipo:</span> " . htmlspecialchars($row["tipo"]) . "</p>";
                echo "<p><span>Localização:</span> " . htmlspecialchars($row["localizacao"]) . "</p>";
                echo "<p><span>Data:</span> " . htmlspecialchars($row["data_registro"]) . "</p>";
                echo "<p><span>Status:</span> HP " . $row["hp"] . " | ATK " . $row["ataque"] . " | DEF " . $row["defesa"] . "</p>";
                echo "<p class='obs'><span>Observações:</span> " . nl2br(htmlspecialchars($row["observacoes"])) . "</p>";

                if (!empty($row["foto"])) {
                    echo "<img src='" . htmlspecialchars($row["foto"]) . "' alt='Foto do Pokémon' class='imagem-pokemon'>";
                }

                echo "<div class='botoes'>";
                echo "<a href='editar.php?id=" . $row["id"] . "' class='btn editar'>Editar</a>";
                echo "<a href='deletar.php?id=" . $row["id"] . "' class='btn excluir' onclick='return confirm(\"Tem certeza que deseja excluir este Pokémon?\")'>Excluir</a>";
                echo "</div>";

                echo "</div>";
            }
        } else {
            echo "<p class='vazio'>Nenhum Pokémon encontrado ainda!</p>";
        }
        ?>
    </div>
</body>
</html>
