<!-- MENU -->
<?php
  $login = new ControladorUsuarios;
  $login -> validarLogin();
  $alumno = new ControladorAlumnos;
  $alumno -> guardarAlumno();
  $Pago = new ControladorPagos;
  $Pago -> guardarPago();
  session_start();
  if (!isset($_SESSION['rol'])) {
    $menu = '';
  } elseif (isset($_SESSION['rol']) && $_SESSION['rol'] == 'sx' || $_SESSION['rol'] == 'Editor') {
    $registrarAlumnos = '';
    $listaAlumnos = '';
    if ($_SESSION['rol'] == 'sx') {
      $listaAlumnos = '
        <a class="nav-link" aria-current="page" href="index.php?seccion=listaAlumnos"><i class="fa-solid fa-user-graduate"></i> Lista Alumnos</a>
        <a class="nav-link" aria-current="page" href="index.php?seccion=listaPagos"><i class="fa-solid fa-dollar-sign"></i> Lista Pagos</a>
        <a class="nav-link" aria-current="page" href="index.php?seccion=listaIngresos"><i class="fa-solid fa-hand-holding-dollar"></i> Lista Ingresos</a>
      ';
      $registrarAlumnos = '
        <li><button class="dropdown-item" onclick="cargarAlumnos()"><i class="fa-solid fa-users-between-lines"></i> Carga Masiva de Alumnos</button></li>
        <li>
          <hr class="dropdown-divider">
        </li>
      ';
    } elseif ($_SESSION['rol'] == 'Editor') {
    }

    $menu = '
      <br>
      <br>
      <br>
      <nav class="navbar fixed-top">
        <div class="container-fluid">
          <a style="width: 2%"><img id="logo" src="./images/logo.jpg" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span style="font-size: 150%"><i class="bi bi-list" style="color: #ffffff;"></i></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <a href="index.php?seccion=inicio" style="width: 50%"><img id="logo" src="./images/logo.jpg" alt=""></a>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" id="menu">
                <li class="nav-item">
                  '.$listaAlumnos.'
                </li>
                <li style="color: white">
                  <hr>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    '.$_SESSION['nombre'].'
                  </a>
                  <ul class="dropdown-menu">
                    '.$registrarAlumnos.'
                    <li><a class="dropdown-item" href="index.php?seccion=logout">Salir <i class="fa-solid fa-right-from-bracket"></i></a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    ';
    echo $menu;
  }
?>
<script>
  // Obtiene la URL actual
  var currentPage = window.location.href;
  // Obtiene todos los enlaces del menú
  var menuLinks = document.getElementById('menu').getElementsByTagName('a');
  var body = document.getElementById('body');
  // Itera sobre los enlaces y agrega la clase "active" al enlace de la página actual
  for (var i = 0; i < menuLinks.length; i++) {
    if (menuLinks[i].href === currentPage) {
      menuLinks[i].classList.add('active');
      switch (menuLinks[i].textContent.trim()) {
        case 'Lista Alumnos':
          body.style.backgroundImage = "url('./images/fondo4.png')";
          break;
        case 'Lista Pagos':
          body.style.backgroundImage = "url('./images/fondo3.png')";
          break;
        case 'Lista Ingresos':
          body.style.backgroundImage = "url('./images/fondo2.png')";
          break;
        default:
          body.style.backgroundImage = "url('./images/fondo1.png')";
          break;
      }
    }
  }
</script>
