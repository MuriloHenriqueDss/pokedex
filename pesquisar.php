<?php
include 'conexao.php';

$pesquisa = isset($_GET['pesquisa']) ? $conn->real_escape_string($_GET['pesquisa']) : '';
$sql = "SELECT * FROM pokemons";
if ($pesquisa != '') {
    $sql .= " WHERE nome LIKE '%$pesquisa%' OR tipo LIKE '%$pesquisa%'";
}
$result = $conn->query($sql);
?>
<link rel="stylesheet" href="./uploads/css/pesquisar.css">
<style>
  .navbar-pokemon {
    position: fixed;
    top: 0;
    left: -250px;
    width: 250px;
    height: 100%;
    background: #f7d02c;
    border-right: 4px solid #2a75bb;
    transition: left 0.3s ease;
    z-index: 1000;
    padding-top: 80px;
  }

  .navbar-pokemon.open {
    left: 0;
  }

  .navbar-links {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .navbar-links li {
    margin: 20px;
    text-align: center;
  }

  .navbar-links a {
    text-decoration: none;
    color: #2a75bb;
    font-family: 'Press Start 2P', Arial, sans-serif;
    font-size: 12px;
  }

  .navbar-logo-text {
    display: none;
  }

  .navbar-hamburger {
    position: fixed;
    top: 20px;
    left: 20px;
    background: none;
    border: none;
    z-index: 1100;
    cursor: pointer;
    animation: pulse 2s infinite;
  }

  .navbar-hamburger svg {
    transition: transform 0.3s ease;
  }

  .navbar-hamburger.rotated svg {
    transform: rotate(90deg);
  }

  @keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
  }
</style>

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
    <li><a href="sobre.php">Listar</a></li>
  </ul>
</nav>


<!-- Formulário de pesquisa -->
<div style="text-align:center; margin-top:40px;">
  <form method="get" action="pesquisar.php">
    <input type="text" name="pesquisa" placeholder="Pesquisar Pokémon" value="<?php echo htmlspecialchars($pesquisa); ?>" style="padding:10px; border-radius:12px; border:2px solid #3b4cca; font-family:'Press Start 2P',Arial,sans-serif; width:220px;">
    <input type="submit" value="Buscar" style="background:linear-gradient(90deg,#ffcb05 0%,#3b4cca 100%); color:#fff; border:2px solid #2a75bb; border-radius:16px; padding:10px 24px; font-family:'Press Start 2P',Arial,sans-serif; cursor:pointer;">
  </form>
</div>

<!-- Container dos cards -->
<div class="pesquisa-container">
<?php while($row = $result->fetch_assoc()): ?>
  <div class="pokemon-card" onclick="abrirModal(
    '<?php echo addslashes($row['nome']); ?>',
    '<?php echo addslashes($row['tipo']); ?>',
    '<?php echo (int)$row['hp']; ?>',
    '<?php echo (int)$row['ataque']; ?>',
    '<?php echo (int)$row['defesa']; ?>',
    '<?php echo addslashes($row['localizacao']); ?>',
    '<?php echo addslashes($row['foto']); ?>'
  )">
    <div class="pokeball-tip">
      <svg viewBox="0 0 56 56">
        <path d="M28,4 a24,24 0 0,1 24,24 h-48 a24,24 0 0,1 24,-24" fill="#ee1c25" stroke="#000" stroke-width="4"/>
        <path d="M52,28 a24,24 0 0,1 -48,0 h48" fill="#fff" stroke="#000" stroke-width="4"/>
        <rect x="4" y="24" width="48" height="8" fill="#222"/>
        <circle cx="28" cy="28" r="10" fill="#fff" stroke="#000" stroke-width="4"/>
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

<!-- Modal de detalhes do Pokémon -->
<div id="pokemonModal" class="modal hidden">
  <div class="modal-content">
    <span class="close-btn" onclick="fecharModal()">&times;</span>
    <img id="modalFoto" src="" alt="Imagem Pokémon">
    <h2 id="modalNome"></h2>
    <p><strong>Tipo:</strong> <span id="modalTipo"></span></p>
    <p><strong>HP:</strong> <span id="modalHp"></span></p>
    <p><strong>Ataque:</strong> <span id="modalAtaque"></span></p>
    <p><strong>Defesa:</strong> <span id="modalDefesa"></span></p>
    <p><strong>Localização:</strong> <span id="modalLocalizacao"></span></p>
  </div>
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
</script>

<script>
  const navbarToggle = document.getElementById('navbarToggle');
  const navbarMenu = document.getElementById('navbarMenu');

  navbarToggle.addEventListener('click', () => {
    navbarMenu.classList.toggle('open');
    navbarToggle.classList.toggle('rotated');
  });
</script>