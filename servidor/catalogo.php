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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"/>
  <link rel="stylesheet" href="css/cabecera.css">
  <link rel="stylesheet" href="estilo-proxecto.css" />
  <title>Catalogo</title>
</head>

<body>
  <nav class="navbar navbar-expand-sm fondomenu font-weight-bold">
    <img class="navbar-brand " src="img/Arman_logo32.png" alt="Logotipo de Arman">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link text-white" href="inventario.php">Inventario</a></li>
      <li class="nav-item"><a class="nav-link text-white activo" href="catalogo.php">Cat&aacute;logo</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="banco_trabajo.php">Banco de trabajo</a></li>
    </ul>
    <!--<div class="navbar-text ml-sm-auto"> -->
    <div class="navbar-text mr-sm-auto"></div>
    <a class="nav-link text-white" href="#">
      <?php
      session_start();
      echo $_SESSION['usuarioSesion'];
      ?>
    </a>
    </div>
  </nav>

  <?php
  include 'soporte.php';

  $manager = new MongoDB\Driver\Manager('mongodb://localhost:27017');

  //$filter = ['_id' => 2];
  //$filter = [];
  $options = [];
  $filter = [];

  $query = new MongoDB\Driver\Query($filter, $options);

  $collection = 'armanpruebas.pepe';
  //$rows = $manager->executeQuery($collection,$query);
  $rows = $manager->executeQuery('armanpruebas.pepe', $query);

  $proyectos = [];
  $pr_finalizados = $pr_encurso = [];

  foreach ($rows as $document) {
      // $dat = array();
      // $dat = asignarDatosProyecto($obj);
      // array_push($proyectos, $dat);
      $document = json_decode(json_encode($document), true);
      if ($document['Finalizado'] == 'true') {
          array_push($pr_finalizados, $document);
      } elseif ($document['Finalizado'] == 'false') {
          array_push($pr_encurso, $document);
      }
      //print_r($document["Titulo"]);
      //array_push($proyectos,$document);
      //print("<br><br>");
  }
  ?>

  <div class="container">
    
    <!-- porlle id aos section, display flex ea unha lista start 
    e a outra end -->
    <section>
      
        <div id="finalizados">
          <h4>Proyectos concluidos</h4>
          <ul>
            <?php foreach ($pr_finalizados as $pro) {
                print '<li onclick="">' . $pro['Titulo'] . '</li>';
            } ?>
          </ul>
        </div>

        <div id="encurso">
          <h4>Proyectos en curso</h4>
          <ul>
            <?php foreach ($pr_encurso as $pro) {
                print '<li onclick="">' . $pro['Titulo'] . '</li>';
            } ?>
          </ul>
        </div>

    </section>

  
    <?php foreach ($pr_finalizados as $pro) { ?>
    <section class="">
        <h3><?php echo $pro['Titulo']; ?></h3>
        <hr>
        <div id="preparacion" class="card">

          <div class="card-header">
            Esquema y componentes
          </div>

          <div class="card-body">
            <p class="card-title">Esquema</p>
            <img class="card-img-top" src="<?php echo $pro[
                'EsquemaElectrico'
            ]; ?>" alt="Esquema eléctrico">
            <p>
              <?php echo $pro['Descripcion']; ?>

            </p>
            <p class="card-title">Componentes</p>

            <?php
            $claves = array_keys($pro['Componentes']);
            echo "<table class='table table-bordered table-hover table-sm'>";
            echo '<tbody>';
            foreach ($claves as $cla) {
                print '<tr><td>' . $cla . '</td>';
                print "<td class='dato'>" .
                    $pro['Componentes'][$cla] .
                    '</td></tr>';
            }
            echo '</tbody>';
            echo '</table>';
            ?>

            <!-- Al hacer clic en este botón se mostrará el código fuente del proyecto-->
            <!-- inactivo por el momento -->
            <button class="btn btn-codigo">C&oacute;digo</button>
          </div>


          <!-- Etapas de montaje -->
              <?php foreach ($pro['Etapas'] as $et) {

                  print "<div class='card'>";
                  print "<div class='card-header'>";
                  // echo $et->Nombre;
                  echo $et['Nombre'];
                  print '</div>';
                  print "<div class='card-body'>";
                  ?>
              <img class="img-fluid" style="float:left; padding-right:10px" src="<?php // echo $et->Imagen
              echo $et['Imagen']; ?>" alt="imagen">

              <p class="text-justify"> <?php // echo $et->Comentario
              echo $et['Comentario']; ?> </p>
            </div>
          </div>
          <?php
              } ?>

      <!-- Resultado final -->
      <div class="card">
        <div class="card-header">
          <p>Resultado final</p>
        </div>
        <div class="card-body">
          <video width="320" height="240" controls src="video/<?php //  echo $pro->Resultado
          echo $pro['Resultado']; ?>"></video>
        </div>
      </div>
    </section>
    <?php } ?>



      <!-- meterlle un foreach para que cargue tódolos proxectos 
      aínda que agochados e ilos amosando sengundo se faga clic nas 
      ligazóns de cadansua listaxe -->

    <?php foreach ($pr_encurso as $pro) { ?>
    <section class="">
        <h3><?php echo $pro['Titulo']; ?></h3>
        <hr>
        <div id="preparacion" class="card">

          <div class="card-header">
            Esquema y componentes
          </div>

          <div class="card-body">
            <p class="card-title">Esquema</p>
            <img class="card-img-top" src="<?php echo $pro[
                'EsquemaElectrico'
            ]; ?>" alt="Esquema eléctrico">
            <p>
              <?php echo $pro['Descripcion']; ?>

            </p>
            <p class="card-title">Componentes</p>

            <?php
            $claves = array_keys($pro['Componentes']);
            echo "<table class='table table-bordered table-hover table-sm'>";
            echo '<tbody>';
            foreach ($claves as $cla) {
                print '<tr><td>' . $cla . '</td>';
                print "<td class='dato'>" .
                    $pro['Componentes'][$cla] .
                    '</td></tr>';
            }
            echo '</tbody>';
            echo '</table>';
            ?>

            <!-- Al hacer clic en este botón se mostrará el código fuente del proyecto-->
            <!-- inactivo por el momento -->
            <button class="btn btn-codigo">C&oacute;digo</button>
          </div>


          <!-- Etapas de montaje -->
              <?php foreach ($pro['Etapas'] as $et) {

                  print "<div class='card'>";
                  print "<div class='card-header'>";
                  // echo $et->Nombre;
                  echo $et['Nombre'];
                  print '</div>';
                  print "<div class='card-body'>";
                  ?>
              <img class="img-fluid" style="float:left; padding-right:10px" src="<?php // echo $et->Imagen
              echo $et['Imagen']; ?>" alt="imagen">

              <p class="text-justify"> <?php // echo $et->Comentario
              echo $et['Comentario']; ?> </p>
            </div>
          </div>
          <?php
              } ?>

      <!-- Resultado final -->
      <div class="card">
        <div class="card-header">
          <p>Resultado final</p>
        </div>
        <div class="card-body">
          <video width="320" height="240" controls src="video/<?php //  echo $pro->Resultado
          echo $pro['Resultado']; ?>"></video>
        </div>
      </div>
    </section>
    <?php } ?>


  </div>

</body>

</html>