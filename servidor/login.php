<!DOCTYPE html>
<html lang="gl_ES">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="img/Arman_logo_favicon.png" type="image/x-icon" />
    <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/inter-ui" type="text/css" />
    <link rel="stylesheet" href="css/estilos-login.css">
  </head>

  <body>

    <div>
      <?php
        if(isset($_POST["acceder"])) {
          if(empty($_POST["user"]) || empty($_POST["password"])) {
            echo "<p class='fallo'> Debe ingresar un nombre de usuario y una contraseña</p>";
          }
          else {
            $usuario = $_POST["user"];
            $password = $_POST["password"];
            include 'soporte.php';
            iniciarSesion($usuario,$password);
          }
        }

      ?>
      
    </div>
    <div class="container">
      <!--<div id="imagen">-->
        <img src="img/Arman_logo128.png" class="img-fluid mx-auto d-block" alt="Logotipo de ArMan" />
      <!--</div>-->
      <!--<h3>ArMan</h3>-->
      
      <form action="" method="post">
        <h3 class="text-center">Introduzca datos de acceso</h3>
        <div class="form-group">
          <label for="user">Usuario </label>
          <input type="text" class="form-control" name="user" id="nombre" />
        </div>
        <div class="form-group">
          <label for="password">Contraseña</label>
          <input type="password" class="form-control" name="password" id="contrasena" />
        </div>
        <button type="submit" name="acceder" class="btn btn-dark">Acceder</button>
      </form>
      <p class="text-center"><a href="creacuenta.php">Obtener una cuenta de acceso</a></p>
    </div>
  </body>
</html>
