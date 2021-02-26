<!DOCTYPE html>
<html lang="es_ES">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ArMan</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="img/Arman_logo_favicon.png" type="image/x-icon" />
    <!-- <link rel="stylesheet" media="screen" href="https://fontlibrary.org/face/inter-ui" type="text/css" /> -->
    <link rel="stylesheet" href="css/am_inicio.css" />
  </head>
  <body>
    <?php
        if(isset($_SESSION["sesionUsuario"])) {
          destroy_session();
        }
    ?>

    <div class="container">
        <header>
            <img src="img/Arman_logo128.png" class="img-fluid mx-auto" alt="Logotipo de ArMan" />
            <h1>ArMan</h1>
            <h6>The Arduino Manager</h6>
            <!-- <p class="lema"> La solución sus problemas de documentación de sus proyectos. </p> -->
        </header>
        <div id="inicio">
          <!-- <button type="button" class="btn btn-primary btn-lg">Iniciar</button>
           -->
           <a class="btn btn-primary btn-lg" href="login.php">Comencemos</a>
        </div>

     <section class="row align-items-baseline">
        <div id="inventario" class="col">
          <h3>Inventario</h3>
          <p>
            Mantenga un registro actualizado de todos los componentes necesarios
            para sus proyectos. En todo momento podá saber si dipone de todo lo
            necesario para llevar a cabo con éxito cualquier creaci&oacute;n.
            ArMan le informar&aacute; del estado del inventario.
          </p>
        </div>
        <div id="catalogo" class="col">
          <h3>Cat&aacute;logo</h3>
          <p>
            En el apartado de Historial podrá tener de manear ordeanada el qué,
            el cómo y todo lo que considere oportuno de sus proyctos finalizados
            ilustrado con imagenes de como llevó cabo la construcción del mismo,
            con anotaciones para recordar eses detalles clave en el éxito de su
            proyecto. Finalice el documento con un video de su proyecto en
            acción!
          </p>
        </div>
        <div id="bancotrabajo" class="col">
          <h3>Banco de trabajo</h3>
          <p>
            Este es el lugar donde transcurre la acción! <br />
            En este apartado puede ir tomando notas, guardar imagenes de sus
            progresos, tener un listado de componentes y herramientas
            utilizadas, gráficos con los esquemas eléctricos... <br />
            Deje que ArMan lleve a cabo la gestión de toda la información que se
            genere. Podrá utilizarla más adelante para crear un documento que
            podr&aacute; guardar en el Historial.
          </p>
        </div>
      </section>
    </div>
  </body>
</html>
