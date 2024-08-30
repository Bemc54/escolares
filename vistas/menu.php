<!-- MENU -->
<?php
  $login = new ControladorUsuarios;
  $login -> validarLogin();
  $alumno = new ControladorAlumnos;
  $alumno -> guardarAlumno();
  $Pago = new ControladorPagos;
  $Pago -> guardarPago();
  $usuario = new ControladorUsuarios;
  $usuario -> guardarUsuario();
  session_start();
  if (!isset($_SESSION['rol'])) {
    $menu = '';
  } elseif (isset($_SESSION['rol'])) {
    $MenuDesp = '';
    $listas = '';
    $listaAlumnos = '<a class="nav-link" aria-current="page" href="index.php?seccion=listaAlumnos"><i class="fa-solid fa-user-graduate"></i> Lista Alumnos</a>';
    $listaPagos = '<a class="nav-link" aria-current="page" href="index.php?seccion=listaPagos"><i class="fa-solid fa-dollar-sign"></i> Lista Pagos</a>';
    $listaIngresos = '<a class="nav-link" aria-current="page" href="index.php?seccion=listaIngresos"><i class="fa-solid fa-hand-holding-dollar"></i> Lista Ingresos</a>';
    $listaAdeudos = '<buttton class="nav-link" onclick="consultarAdeudo()"><i class="fa-solid fa-sack-dollar"></i> Lista Adeudos</button>';
    $craerUsuarios = '';
    $cargarAlumnos = '<li><button class="dropdown-item" onclick="cargarAlumnos()"><i class="fa-solid fa-users-between-lines"></i> Carga Masiva de Alumnos</button></li>';
    $corteDia = '<li><a class="dropdown-item" href="index.php?seccion=corteDia"><span class="fa fa-cash-register"></span> Corte de Caja del Día</a></li>';
    $corteDia2 = '<li><button class="dropdown-item" onclick="corteDia()"><span class="fa fa-calendar-day"></span> Corte de Caja de días anteriores</button></li>';
    $corteRango = '<li><button class="dropdown-item" onclick="corteRango()"><span class="fa fa-calendar-days"></span> Corte de Caja de un rango de fechas</button></li>';
    if ($_SESSION['rol'] == 'sx') {
      $eliminarCarrera = new ControladorCarreras();
      $eliminarCarrera -> eliminarCarrera();
      $carreras = ControladorCarreras::consultaCarreras();
      $eliminarConcepto = new ControladorConceptos();
      $eliminarConcepto -> eliminarConcepto();
      $conceptos = ControladorConceptos::consultaConceptos();
      $opConceptos = '';
      $opCarreras = '';
      foreach ($carreras as $row => $item) {
        $opCarreras .= '
          <td style="justify-content:space-between; display: flex;">
            '.$item[1].'
            <a class="btn btn-icon btn-danger" href="index.php?seccion=listaAlumnos&id='.$item[0].'&accion=Bcarrera"><i class="fa-solid fa-trash"></i></a>
          </td>
        ';
      }
      foreach ($conceptos as $row => $item) {
        $opConceptos .= '
          <td style="justify-content:space-between; display: flex;">
            '.$item[1].'
            <a class="btn btn-icon btn-danger" href="index.php?seccion=listaPagos&id='.$item[0].'&accion=Bconcepto"><i class="fa-solid fa-trash"></i></a>
          </td>
        ';
      }
      $craerUsuarios = '
        <button id="add" style="top:3.5%; width: 22rem; transform: translate(-50%, -50%); left: 50%;" class="btn btn-outline-dark border border-dark" onclick="crearUsuarios()"><span class="fa fa-user-plus"></span> Crear Usuario Nuevo</button>
        <button id="add" style="font-size: 1rem; top:3.5%; width: 10rem; height: 3rem; transform: translate(-50%, -50%); left: 13%;" class="btn btn-outline-danger border border-danger" onclick="carreras()"><span class="fa fa-trash"></span> Eliminar Carrera</button>
        <button id="add" style="font-size: 1rem; top:3.5%; width: 10rem; height: 3rem; transform: translate(-50%, -50%); right: 13%;" class="btn btn-outline-danger border border-danger" onclick="conceptos()"><span class="fa fa-trash"></span> Eliminar Concepto de Pago</button>

        <script>
          function carreras() {
            Swal.fire({
              title: "Selecciona la Carrera que desees eliminar",
              html: `
                <form class="p-3 card bg-info" action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover">
                      <tbody>
                        <tr>
                          '.$opCarreras.'
                        </tr>
                      </tbody>
                    </table>
                </form>
              `,
              showCloseButton: true,
              showConfirmButton: false,
              width: 400,
            })
          }
          function conceptos() {
            Swal.fire({
              title: "Selecciona el Concepto de Pago que desees eliminar",
              html: `
                <form class="p-3 card bg-info" action="" method="post" enctype="multipart/form-data">
                    <table class="table table-hover">
                      <tbody>
                        <tr>
                          '.$opConceptos.'
                        </tr>
                      </tbody>
                    </table>
                </form>
              `,
              showCloseButton: true,
              showConfirmButton: false,
              width: 400,
            })
          }
        </script>
      ';
      $listas = $listaAlumnos . $listaPagos . $listaIngresos . $listaAdeudos;
      $MenuDesp = $cargarAlumnos . $corteDia . $corteDia2 . $corteRango;
    } elseif ($_SESSION['rol'] == 'Conta') {
      $listas = $listaAlumnos . $listaPagos . $listaIngresos . $listaAdeudos;
      $MenuDesp = $cargarAlumnos . $corteDia . $corteDia2 . $corteRango;
    } elseif ($_SESSION['rol'] == 'Administrativo') {
      $listas = $listaAlumnos . $listaIngresos . $listaAdeudos;
      $MenuDesp = $corteDia;
    }

    $menu = '
      <br>
      <br>
      <br>
      <nav class="navbar fixed-top">
        '.$craerUsuarios.'
        <div class="container-fluid">
          <a style="width: 2%"><img id="logo" src="./images/logo.png" alt=""></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
            <span style="font-size: 150%"><i class="bi bi-list" style="color: #ffffff;"></i></span>
          </button>
          <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
              <a href="index.php?seccion=inicio" style="width: 50%"><img id="logo" src="./images/logo.png" alt=""></a>
              <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
              <ul class="navbar-nav justify-content-end flex-grow-1 pe-3" id="menu">
                <li class="nav-item">
                  '.$listas.'
                </li>
                <li style="color: white">
                  <hr>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    '.$_SESSION['nombre'].'
                  </a>
                  <ul class="dropdown-menu">
                    '.$MenuDesp.'
                    <li>
                      <hr class="dropdown-divider">
                    </li>
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
