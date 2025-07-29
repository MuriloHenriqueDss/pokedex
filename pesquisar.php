<?php
include 'conexao.php';

$pesquisa = isset($_GET['pesquisa']) ? $conn->real_escape_string($_GET['pesquisa']) : '';
$sql = "SELECT * FROM pokemons";
if ($pesquisa != '') {
    $sql .= " WHERE nome LIKE '%$pesquisa%' OR tipo LIKE '%$pesquisa%'";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Pesquisar Pokémon</title>
<link rel="stylesheet" href="./uploads/css/pesquisar.css" />
<style>
@import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap');

/* Navbar lateral */
.navbar-pokemon {
  position: fixed;
  top: 0;
  left: -250px; /* escondido à esquerda */
  width: 220px;
  height: 100%;
  transition: left 0.3s ease;
  z-index: 1000;
  padding-top: 80px;
  box-shadow: 4px 0 12px rgba(0,0,0,0.2);
  background: linear-gradient(180deg, #ffcb05 0%, #ffcb05 50%);
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
}

/* Botão Pokébola */
.navbar-hamburger {
  position: fixed;
  top: 20px;
  left: 20px;
  background: linear-gradient(180deg, #ffcb05 0%, #ffcb05 50%);
  border: none;
  cursor: pointer;
  z-index: 1100;
  animation: pulse 2s infinite;
  padding: 0;
}

.navbar-hamburger svg {
  display: block;
  transition: transform 0.3s ease;
  width: 50px;
  height: 50px;
}

.navbar-hamburger.rotated svg {
  transform: rotate(90deg);
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.1); }
  100% { transform: scale(1); }
}

/* Outras estilizações da página */
body {
  font-family: 'Press Start 2P', Arial, sans-serif;
  background: linear-gradient(135deg, #f7d02c 0%, #ee8130 100%);
  min-height: 100vh;
  margin: 0;
  padding: 0;
  overflow-x: hidden;
  color: #222;
  display: flex;
  flex-direction: column;
  align-items: center;
}

.pesquisa-form {
  text-align: center;
  margin-top: 100px;
  margin-bottom: 40px;
  z-index: 1;
  position: relative;
}

.pesquisa-form input[type="text"] {
  padding: 12px;
  border-radius: 12px;
  border: 2px solid #3b4cca;
  font-family: 'Press Start 2P', Arial, sans-serif;
  width: 240px;
  background: #fff;
  font-size: 0.75rem;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.pesquisa-form input[type="text"]:focus {
  border-color: #ee8130;
  box-shadow: 0 0 8px #ee8130;
  outline: none;
}

.pesquisa-form input[type="submit"] {
  background: linear-gradient(90deg, #ffcb05 0%, #3b4cca 100%);
  color: #fff;
  border: 2px solid #2a75bb;
  border-radius: 16px;
  padding: 10px 24px;
  font-family: 'Press Start 2P', Arial, sans-serif;
  cursor: pointer;
  margin-left: 8px;
  font-size: 0.75rem;
  transition: background 0.2s, transform 0.2s;
}

.pesquisa-form input[type="submit"]:hover {
  background: linear-gradient(90deg, #ee8130 0%, #3b4cca 100%);
  transform: scale(1.08) rotate(-2deg);
  box-shadow: 0 4px 16px #3b4cca;
}

.pesquisa-container {
  max-width: 1200px;
  margin: 0 auto 40px auto;
  padding: 16px;
  display: flex;
  flex-wrap: wrap;
  gap: 32px;
  justify-content: center;
  z-index: 1;
  position: relative;
}

.pokemon-card {
  position: relative;
  background: rgba(255,255,255,0.98);
  border: 4px solid #000;
  border-radius: 24px;
  box-shadow: 0 8px 32px rgba(59,76,202,0.2);
  width: 260px;
  padding: 32px 24px 24px 24px;
  margin: 0;
  transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
  cursor: pointer;
  text-align: center;
  font-size: 0.7rem;
}

.pokemon-card:hover {
  transform: scale(1.07) rotate(-2deg);
  box-shadow: 0 16px 48px #3b4cca99;
  border-color: #3b4cca;
  filter: brightness(1.08) contrast(1.1);
}

.pokemon-card .pokeball-tip {
  position: absolute;
  top: -28px;
  right: -28px;
  width: 56px;
  height: 56px;
  z-index: 10;
  transition: transform 0.3s;
  pointer-events: none;
  filter: drop-shadow(0 2px 8px #ee8130);
}

.pokemon-card:hover .pokeball-tip {
  transform: rotate(30deg) scale(1.2);
  filter: drop-shadow(0 0 16px #ee8130);
}

.pokeball-tip svg {
  width: 100%;
  height: 100%;
  display: block;
}

.pokemon-card h3 {
  font-size: 1.2rem;
  color: #3b4cca;
  margin: 0 0 12px 0;
  text-shadow: 1px 1px #ffcb05;
}

.pokemon-card .tipo {
  font-size: 1rem;
  color: #ee8130;
  margin-bottom: 8px;
  font-weight: bold;
}

.pokemon-card .stats {
  font-size: 0.95rem;
  color: #2a75bb;
  margin-bottom: 8px;
}

.pokemon-card .local {
  font-size: 0.9rem;
  color: #555;
  margin-bottom: 8px;
}

.pokemon-card .foto {
  width: 100px;
  height: 100px;
  object-fit: contain;
  border-radius: 12px;
  margin-bottom: 12px;
  border: 2px solid #3b4cca;
  background: #f7d02c;
  box-shadow: 0 2px 8px #ee8130;
  transition: box-shadow 0.2s;
}

.pokemon-card:hover .foto {
  box-shadow: 0 4px 16px #3b4cca;
}

/* Modal */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0,0,0,0.75);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 2000;
}

.modal.hidden {
  display: none;
}

.modal-content {
  background: #fff;
  border: 4px solid #3b4cca;
  border-radius: 20px;
  padding: 30px;
  width: 90%;
  max-width: 400px;
  font-family: 'Press Start 2P', Arial, sans-serif;
  color: #222;
  position: relative;
  text-align: center;
}

.modal-content img {
  width: 120px;
  height: 120px;
  object-fit: contain;
  margin-bottom: 15px;
}

.modal-content p {
  font-size: 10px;
  margin: 10px 0;
}

.close-btn {
  position: absolute;
  top: 12px;
  right: 20px;
  font-size: 24px;
  cursor: pointer;
  color: #f00;
}

/* Responsivo */
@media (max-width: 700px) {
  .pesquisa-container {
    flex-direction: column;
    align-items: center;
    gap: 24px;
  }
  .pokemon-card {
    width: 90vw;
    max-width: 340px;
  }
}
</style>
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


<!-- Formulário de pesquisa -->
<div class="pesquisa-form">
  <form method="get" action="pesquisar.php">
    <input type="text" name="pesquisa" placeholder="Pesquisar Pokémon" value="<?php echo htmlspecialchars($pesquisa); ?>">
    <input type="submit" value="Buscar">
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
    <div class="pokeball-tip" aria-hidden="true">
      <svg viewBox="0 0 56 56" xmlns="http://www.w3.org/2000/svg">
        <path d="M28,4 a24,24 0 0,1 24,24 h-48 a24,24 0 0,1 24,-24" fill="#ee1c25" stroke="#000" stroke-width="4"/>
        <path d="M52,28 a24,24 0 0,1 -48,0 h48" fill="#fff" stroke="#000" stroke-width="4"/>
        <rect x="4" y="24" width="48" height="8" fill="#222"/>
        <circle cx="28" cy="28" r="10" fill="#fff" stroke="#000" stroke-width="4"/>
        <circle cx="28" cy="28" r="5" fill="#ccc" stroke="#222" stroke-width="2"/>
      </svg>
    </div>
    <?php if($row['foto']): ?>
      <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto de <?php echo htmlspecialchars($row['nome']); ?>" class="foto">
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

<!-- Modal -->
<div id="pokemonModal" class="modal hidden" role="dialog" aria-modal="true" aria-labelledby="modalNome">
  <div class="modal-content">
    <button class="close-btn" aria-label="Fechar modal" onclick="fecharModal()">&times;</button>
    <img id="modalFoto" src="" alt="Imagem do Pokémon">
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
