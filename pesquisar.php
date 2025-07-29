<?php
include 'conexao.php';

$pesquisa = "";
if (isset($_GET['pesquisa'])) {
    $pesquisa = $conn->real_escape_string($_GET['pesquisa']);
    $sql = "SELECT * FROM pokemons WHERE nome LIKE '%$pesquisa%'";
} else {
    $sql = "SELECT * FROM pokemons";
}
$result = $conn->query($sql);
?>
<link rel="stylesheet" href="./uploads/css/pesquisar.css">

<div class="pokeball-bg">
  <div class="pokeball"></div>
  <div class="pokeball"></div>
  <div class="pokeball"></div>
  <div class="pokeball"></div>
</div>

<nav class="navbar-pokemon">
  <button class="navbar-hamburger" id="navbarToggle" aria-label="Abrir menu">
    <svg viewBox="0 0 32 32" width="40" height="40">
      <circle cx="16" cy="16" r="14" fill="#fff" stroke="#2a75bb" stroke-width="3"/>
      <path d="M16,2 a14,14 0 0,1 14,14 h-28 a14,14 0 0,1 14,-14" fill="#ee1c25" stroke="#2a75bb" stroke-width="3"/>
      <rect x="2" y="14" width="28" height="4" fill="#222"/>
      <circle cx="16" cy="16" r="5" fill="#fff" stroke="#2a75bb" stroke-width="2"/>
      <circle cx="16" cy="16" r="2.5" fill="#ccc" stroke="#222" stroke-width="1"/>
    </svg>
  </button>
  <span class="navbar-logo-text">Pokédex</span>
  <ul class="navbar-links" id="navbarMenu">
    <li><a href="index.php">Início</a></li>
    <li><a href="cadastrar.php">Cadastrar</a></li>
    <li><a href="pesquisar.php">Pesquisar</a></li>
    <li><a href="sobre.php">Sobre</a></li>
  </ul>
</nav>

<div style="text-align:center; margin-top:40px;">
  <form method="get" action="pesquisar.php">
    <input type="text" name="pesquisa" placeholder="Pesquisar Pokémon" value="<?php echo htmlspecialchars($pesquisa); ?>" style="padding:10px; border-radius:12px; border:2px solid #3b4cca; font-family:'Press Start 2P',Arial,sans-serif; width:220px;">
    <input type="submit" value="Buscar" style="background:linear-gradient(90deg,#ffcb05 0%,#3b4cca 100%); color:#fff; border:2px solid #2a75bb; border-radius:16px; padding:10px 24px; font-family:'Press Start 2P',Arial,sans-serif; cursor:pointer;">
  </form>
</div>

<div class="pesquisa-container">
<?php while($row = $result->fetch_assoc()): ?>
  <div class="pokemon-card">
<div class="pokeball-tip">
  <svg viewBox="0 0 56 56">
    <!-- Metade superior vermelha -->
    <path d="M28,4
             a24,24 0 0,1 24,24
             h-48
             a24,24 0 0,1 24,-24"
          fill="#ee1c25" stroke="#000" stroke-width="4"/>
    <!-- Metade inferior branca -->
    <path d="M52,28
             a24,24 0 0,1 -48,0
             h48"
          fill="#fff" stroke="#000" stroke-width="4"/>
    <!-- Faixa preta -->
    <rect x="4" y="24" width="48" height="8" fill="#222"/>
    <!-- Círculo central branco -->
    <circle cx="28" cy="28" r="10" fill="#fff" stroke="#000" stroke-width="4"/>
    <!-- Círculo central cinza -->
    <circle cx="28" cy="28" r="5" fill="#ccc" stroke="#222" stroke-width="2"/>
  </svg>
</div>
    <?php if($row['foto']): ?>
      <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto" class="foto">
    <?php endif; ?>
    <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
    <div class="tipo"><?php echo htmlspecialchars($row['tipo']); ?></div>
    <div class="stats">
      HP: <?php echo (int)$row['hp']; ?> | 
      Ataque: <?php echo (int)$row['ataque']; ?> | 
      Defesa: <?php echo (int)$row['defesa']; ?>
    </div>
    <div class="local"><?php echo htmlspecialchars($row['localizacao']); ?></div>
  </div>
<?php endwhile; ?>
</div>