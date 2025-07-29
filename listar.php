<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pokémons</title>
    <link rel="stylesheet" href="./uploads/css/estilo-lista.css">
</head>
<body>
    <nav class="navbar-pokemon" id="navbar">
  <button class="navbar-hamburger" id="navbarToggle" aria-label="Abrir menu">
    <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
      <circle cx="28" cy="28" r="24" fill="#fff" />
      <path d="M28,4 a24,24 0 0,1 24,24 h-48 a24,24 0 0,1 24,-24" fill="#ee1c25" />
      <rect x="4" y="24" width="48" height="8" fill="#222" />
      <circle cx="28" cy="28" r="10" fill="#fff" stroke="#000" stroke-width="4" />
      <circle cx="28" cy="28" r="5" fill="#ccc" stroke="#222" stroke-width="2" />
    </svg>
  </button>

  <ul class="navbar-links" id="navbarMenu">
    <li><a href="index.php">Início</a></li>
    <li><a href="cadastrar.php">Cadastrar</a></li>
    <li><a href="pesquisar.php">Pesquisar</a></li>
    <li><a href="listar.php">Listar</a></li>
  </ul>
</nav>
    <link rel="stylesheet" href="./uploads/css/cadastrar.css">
    <div class="pokeball-fundo">
        <div class="pokeball"></div>
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
    <script>
  function abrirModal(nome, tipo, hp, ataque, defesa, localizacao, foto) {
    document.getElementById('modalNome').innerText = nome;
    document.getElementById('modalTipo').innerText = tipo;
    document.getElementById('modalHp').innerText = hp;
    document.getElementById('modalAtaque').innerText = ataque;
    document.getElementById('modalDefesa').innerText = defesa;
    document.getElementById('modalLocalizacao').innerText = localizacao;
    document.getElementById('modalFoto').src = foto;
    document.getElementById('pokemonModal').classList.remove('hidden');
  }

  function fecharModal() {
    document.getElementById('pokemonModal').classList.add('hidden');
  }

  // Navbar toggle
  const navbarToggle = document.getElementById('navbarToggle');
  const navbar = document.getElementById('navbar');

  navbarToggle.addEventListener('click', () => {
    navbar.classList.toggle('open');
    navbarToggle.classList.toggle('rotated');
  });
</script>
</body>
</html>
