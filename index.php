<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pokédex - Início</title>
    <link rel="stylesheet" href="./uploads/css/pesquisar.css">
</head>
<body>
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

    <div class="pokeball-bg">
      <div class="pokeball"></div>
      <div class="pokeball"></div>
      <div class="pokeball"></div>
      <div class="pokeball"></div>
    </div>

    <main class="index-main">
        <h1>Bem-vindo à Pokédex!</h1>
        <p>
            Explore, cadastre e pesquise Pokémons como um verdadeiro mestre.<br>
            Clique abaixo para começar sua jornada!
        </p>
        <a href="pesquisar.php" class="btn-pokedex">
            Acessar Pokédex
        </a>
    </main>
    <script>
    const navbarToggle = document.getElementById('navbarToggle');
    const navbarMenu = document.getElementById('navbarMenu');
    navbarToggle.addEventListener('click', () => {
        navbarMenu.classList.toggle('open');
    });
    </script>
</body>
</html>