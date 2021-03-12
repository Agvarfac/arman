<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" />
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/> -->
  <!-- <link rel="stylesheet" href="estilo-proxecto.css" /> -->
  <title>Catalogo</title>
</head>

<body>
  <nav class="navbar navbar-expand-sm fondomenu font-weight-bold">
    <img class="navbar-brand " src="img/Arman_logo32.png" alt="Logotipo de Arman">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link text-white" href="#">Inventario</a></li>
      <li class="nav-item"><a class="nav-link text-white activo" href="#">Cat&aacute;logo</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="#">Banco de trabajo</a></li>
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

  <?php
    include '../SQLPHP/soporte.php';

    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");

    $filter = ['_id' => 3];
    $options = [];

    $query = new MongoDB\Driver\Query($filter,$options);
    //$collection='proyarman.'.$_SESSION["usuarioSesion"];
    $collection=$mongodb.$_SESSION["usuarioSesion"];
    $rows = $manager->executeQuery($collection,$query);

    $proyectos = array();

    foreach($rows as $obj) {
      $dat = array();
      $dat = asignarDatosProyecto($obj);
      array_push($proyectos, $dat);
    }

  ?>

  <div class="container">

    <?php
      foreach($proyectos as $pro) {
    ?>

    <section>
      <div id="finalizados">
        <h4>Proyectos concluidos</h4>
        <ul>
      <?php
        if($pro->Finalizado == "true") {
          print('<li>'.$pro->Titulo.'</li>');
        }        
      ?>
        </ul>
      </div>

      <div id="encurso">
        <h4>Proyectos en curso</h4>
        <ul>
      <?php
        if($pro->Finalizado == "false") {
          print('<li>'.$pro->Titulo.'</li>');
        }
      ?>
        </ul>
      </div>

    </section>


    <section class="d-none">
      <h3><?php echo $pro["Titulo"] ?></h3>
      <hr>
      <div id="preparacion" class="card">
        <div class="card-header">
          Esquema y componentes
        </div>
        <div class="card-body">
          <p class="card-title">Esquema</p>
          <img class="card-img-top" src="<?php echo $pro["EsquemaElectrico"] ?>" alt="Esquema eléctrico">
          <p>
            <?php echo $pro["Descripcion"] ?>

          </p>
          <p class="card-title">Componentes</p>

          <?php
              $claves = array_keys($pro["Componentes"]);
              echo "<table class='table table-bordered table-hover table-sm'>";
              echo "<tbody>";
              foreach ($claves as $cla) {
                print("<tr><td>".$cla."</td>");
                print("<td class='dato'>".$pro['Componentes'][$cla]."</td></tr>");
              }
              echo "</tbody>";
              echo "</table>";

          ?>

          <!-- Al hacer clic en este botón se mostrará el código fuente del proyecto-->
          <!-- inactivo por el momento -->
          <button class="btn btn-codigo">C&oacute;digo</button>
        </div>


        <!-- Etapas de montaje -->
        <?php
          foreach($pro["Etapas"] as $et){
          print("<div class='card'>");
          print("<div class='card-header'>");
          echo $et->Nombre;
          print("</div>");
          print("<div class='card-body'>");     
        ?>
        <img class="img-fluid" style="float:left; padding-right:10px" src="<?php echo $et->Imagen ?>" alt="imagen">

        <p class="text-justify"> <?php echo $et->Comentario?> </p>
      </div>
  </div>
  <?php }?>

  <!-- Resultado final -->
  <div class="card">
    <div class="card-header">
      <p>Resultado final</p>
    </div>
    <div class="card-body">
      <video width="320" height="240" controls src="video/<?php echo $pro->Resultado ?>"></video>
    </div>

  </div>
  </section>
  <?php } ?>

</body>

</html>