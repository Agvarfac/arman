<!DOCTYPE html>
<html lang="gl_ES">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://kit.fontawesome.com/77356eab9e.js" crossorigin="anonymous"></script>
  <link rel="shortcut icon" href="img/Arman_logo_favicon.png" type="image/x-icon">
  <!--<link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/inter-ui" type="text/css" /> -->
  <link rel="stylesheet" href="css/cabecera.css">
  <link rel="stylesheet" href="css/comienzo.css">
</head>

<body>
<nav class="navbar navbar-expand-sm fondomenu font-weight-bold">
    <img class="navbar-brand " src="img/Arman_logo32.png" alt="Logotipo de Arman">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link text-white" href="inventario.php">Inventario</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="catalogo.php">Cat&aacute;logo</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="banco_trabajo.php">Banco de trabajo</a></li>
    </ul>
    <!--<div class="navbar-text ml-sm-auto"> -->
    <div class="navbar-text mr-sm-auto"></div>
      <a class="nav-link text-white" href="#">
      <?php 
        session_start();
        echo $_SESSION["usuarioSesion"];
      ?>
      </a>
    </div>
  </nav>

  <div class="container">
    <div class="mensaje">
      <!-- <img src="img/Arman_logo64.png" alt=""><br> -->
      <p>Bienvenido a Arman.</p>
      <p>Para comenzar escoja una opci&oacute;n del menú superior.</p>
    </div>
  </div>
</body>