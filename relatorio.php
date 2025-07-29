<?php
include 'conexao.php';

// Consulta todos os pokémons cadastrados, ordenando por data mais recente
$sql = "SELECT nome, tipo, localizacao, data_registro FROM pokemons ORDER BY data_registro DESC";
$result = $conn->query($sql);

// Consulta para contar total de pokémons
$sqlTotal = "SELECT COUNT(*) as total FROM pokemons";
$totalResult = $conn->query($sqlTotal);
$totalRow = $totalResult->fetch_assoc();
$totalPokemons = $totalRow['total'];

// Consulta para contar quantidade por tipo
$sqlTipos = "SELECT tipo, COUNT(*) as quantidade FROM pokemons GROUP BY tipo ORDER BY quantidade DESC";
$tiposResult = $conn->query($sqlTipos);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <title>Relatório de Pokémons Registrados</title>
    <link rel="stylesheet" href="./uploads/css/relatorio.css" />
  
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
        <li><a href="relatorio.php">Relatório</a></li>
    </ul>
    </nav>

  <h2>Relatório de Pokémons Registrados</h2>
  
  <div class="summary">
    Total de Pokémons cadastrados: <strong><?php echo $totalPokemons; ?></strong>
  </div>

  <section class="tipo-list" aria-label="Quantidade de Pokémons por tipo">
    <h3>Quantidade por Tipo</h3>
    <ul>
      <?php while($tipo = $tiposResult->fetch_assoc()): ?>
        <li><?php echo htmlspecialchars($tipo['tipo']); ?>: <?php echo $tipo['quantidade']; ?></li>
      <?php endwhile; ?>
    </ul>
  </section>

  <table role="table" aria-label="Tabela de pokémons cadastrados">
    <thead>
      <tr>
        <th scope="col">Nome</th>
        <th scope="col">Tipo</th>
        <th scope="col">Localização</th>
        <th scope="col">Data de Registro</th>
      </tr>
    </thead>
    <tbody>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td data-label="Nome"><?php echo htmlspecialchars($row['nome']); ?></td>
          <td data-label="Tipo"><?php echo htmlspecialchars($row['tipo']); ?></td>
          <td data-label="Localização"><?php echo htmlspecialchars($row['localizacao']); ?></td>
          <td data-label="Data de Registro"><?php echo date('d/m/Y', strtotime($row['data_registro'])); ?></td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  
  <script>
    const navbarToggle = document.getElementById('navbarToggle');
  const navbar = document.getElementById('navbar');

  navbarToggle.addEventListener('click', () => {
    navbar.classList.toggle('open');
    navbarToggle.classList.toggle('rotated');
  });
  </script>
</body>
</html>
