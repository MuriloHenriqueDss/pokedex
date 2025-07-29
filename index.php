<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pokédex - Início</title>
    <link rel="stylesheet" href="./uploads/css/pesquisar.css">
    <style>
        .navbar-pokemon {
            background: linear-gradient(90deg, #3b4cca 0%, #ffcb05 100%);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            border-radius: 0 0 32px 32px;
            box-shadow: 0 6px 24px #3b4cca33;
            font-family: 'Press Start 2P', Arial, sans-serif;
            position: relative;
            z-index: 100;
        }
        .navbar-logo-text {
            color: #fff;
            text-shadow: 2px 2px #2a75bb;
            font-size: 1.3rem;
            margin-left: 12px;
            letter-spacing: 2px;
        }
        .navbar-hamburger {
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
            margin-right: 8px;
            outline: none;
            transition: transform 0.2s;
        }
        .navbar-hamburger:active {
            transform: scale(1.1) rotate(-10deg);
        }
        .navbar-links {
            flex-direction: column;
            position: fixed;
            top: 0;
            right: -260px;
            width: 220px;
            height: 100vh;
            background: linear-gradient(180deg, #3b4cca 0%, #ffcb05 100%);
            box-shadow: -4px 0 24px #3b4cca33;
            padding-top: 80px;
            gap: 18px;
            transition: right 0.3s;
            z-index: 999;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .navbar-links.open {
            right: 0;
        }
        .navbar-links li a {
            color: #fff;
            text-decoration: none;
            font-size: 1.05rem;
            padding: 12px 18px;
            border-radius: 16px;
            margin: 0 8px;
            display: block;
            font-family: 'Press Start 2P', Arial, sans-serif;
            transition: background 0.2s, color 0.2s, transform 0.2s;
        }
        .navbar-links li a:hover {
            background: #ee8130;
            color: #3b4cca;
            transform: scale(1.08);
        }
    </style>
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