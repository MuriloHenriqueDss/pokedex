<?php include 'conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pokédex - Início</title>
    <link rel="stylesheet" href="./uploads/css/pesquisar.css">
    <style>
        body {
            position: relative;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            background: #f7d02c;
        }
        .navbar-pokemon {
            position: fixed;
            top: 0;
            left: -250px; /* escondido à esquerda */
            width: 220px;
            height: 100%;
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.2);
            transition: left 0.3s ease;
            z-index: 1000;
            padding-top: 80px;
            font-family: 'Press Start 2P', Arial, sans-serif;
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
            margin: 24px 0;
            text-align: center;
        }

        .navbar-links a {
            text-decoration: none;
            color: #3b4cca;
            font-size: 1rem;
            display: block;
            padding: 12px 0;
            border-radius: 12px;
            background: rgba(59,76,202,0.12);
            box-shadow: 0 2px 8px #3b4cca22;
            transition: background 0.2s, color 0.2s, transform 0.2s;
            font-family: 'Press Start 2P', Arial, sans-serif;
            letter-spacing: 1px;
        }

        .navbar-links a:hover {
            background: #ee8130;
            color: #f7d02c;
            transform: scale(1.07);
            box-shadow: 0 4px 16px #ee813044;
        }

        .navbar-hamburger {
            position: fixed;
            top: 20px;
            left: 20px;
            background: none;
            border: none;
            cursor: pointer;
            z-index: 1100;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .navbar-hamburger svg {
            width: 50px;
            height: 50px;
            transition: transform 0.3s ease;
        }

        .navbar-hamburger.rotated svg {
            transform: rotate(90deg);
        }
        .btn-pokedex {
            display: flex;
            background: linear-gradient(90deg, #ffcb05 0%, #3b4cca 100%);
            color: #fff;
            padding: 12px 24px;
            border-radius: 16px;
            text-decoration: none;
            align-items: center;
            justify-content: center;
            font-family: 'Press Start 2P', Arial, sans-serif;
            font-size: 1.2rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            transition: background 0.3s, color 0.3s, transform 0.3s;
            margin-top: 20%;
        }
        .index-main {
            text-align: center;
            color: #fff;
            font-family: 'Press Start 2P', Arial, sans-serif;
            margin-top: 100px;
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
    <main class="index-main">
        <h1>Bem-vindo à Pokédex!</h1>
        <p>
            Explore, cadastre e pesquise Pokémons como um verdadeiro mestre.<br>
            Clique abaixo para começar sua jornada e <br> encontrar pokémon que foram cadastrados e perdidos em Caçapava!
        </p>
        <a href="pesquisar.php" class="btn-pokedex">
            Acessar Pokédex
        </a>
    </main>
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