  const navbarToggle = document.getElementById('navbarToggle');
  const navbar = document.getElementById('navbar');

  navbarToggle.addEventListener('click', () => {
    navbar.classList.toggle('open');
    navbarToggle.classList.toggle('rotated');
  });