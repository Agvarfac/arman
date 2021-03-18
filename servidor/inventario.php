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
  <link rel="stylesheet" href="css/cabecera.css">
  <link rel="stylesheet" href="css/inventario.css">
</head>

<body>
  <nav class="navbar navbar-expand-sm fondomenu font-weight-bold">
    <img class="navbar-brand " src="img/Arman_logo32.png" alt="Logotipo de Arman">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link text-white activo" href="inventario.php">Inventario</a></li>
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

  <div class="container-fluid">

    <div id="listas" class="align-content-center">

      <aside class="componentes">
        <h4>Componentes</h4>
        <ul class="lista-componentes">
          <li><a id="cc" href="#">Componentes complejos</a></li>
          <li><a id="ca" href="#">Cables</a></li>
          <li><a id="se" href="#">Sensores</a></li>
          <li><a id="le" href="#">LED</a></li>
          <li><a id="tr" href="#">Transistores</a></li>
          <li><a id="co" href="#">Condensadores</a></li>
          <li><a id="di" href="#">Diodos</a></li>
          <li><a id="re" href="#">Resistencias</a></li>
          <li><a id="ot" href="#">Otros</a></li>
        </ul>
      </aside>

      
      <?php
        include "soporte.php";

        /*Obteniendo el listado de tablas de la base de datos */
        $lista_tablas = leerNombreTablas($bdNombre);
        //print_r($lista_tablas);
        //$dni = $dniDB; // obtenido del inicio de sesión.
        $dni="11111111H";

        foreach ($lista_tablas as $dato) {
          if($dato != "usuarios") {
            $datos_tabla[$dato] = obtenerDatosTabla($dato,$bdNombre,$dni);
            /* Este paso intermedio es necesario porque $datos_tabulados da como $resultado
            *  dos arrays anidados. El array exterior solo tiene un elemento que es el array
            *  con los resultados de la consulta a cada tabla.
            */
            $datos_tabulados = $datos_tabla[$dato]->fetchAll(PDO::FETCH_ASSOC);
            $tab= $datos_tabulados[0];
                
            echo '<section id="'.$dato.'" class="d-none">';
            echo "<h4>".substr($dato,4)."<i id='volver' class='fas fa-caret-square-left d-none'></i></h4>";
            echo '<table class="table table-striped" id="items">';
            echo '<tr><th>Nombre</th><th>Cantidad</tr>';
            mostrarDatos($tab);
            echo '</table>';
            echo '</section>';
          }
        }

      ?>
    </div>
  </div>

  <script>
  
    $(document).ready(function(){

      if ($(window).width() > 768) {
      var tabla_previa;
      $('.lista-componentes>li>a').on("click", function(){
          //console.log($(this).attr("id"));
          
          var id_opcion = $(this).attr("id");
          //id_opcion = "#"+id_opcion;
          //console.log(id_opcion);
          switch(id_opcion){
            case "cc":
              var id_tabla = "#inv_Complejos";
              break;
            case "ca":
              var id_tabla = "#inv_Cables";
              break;
            case "se":
              var id_tabla = "#inv_Sensores";
              break;
            case "le":
              var id_tabla = "#inv_LED";
              break;
            case "tr":
              var id_tabla = "#inv_Transitores";
              break;
            case "co":
              var id_tabla = "#inv_Condensadores";
              break;
            case "di":
              var id_tabla = "#inv_Diodos";
              break;
            case "re":
              var id_tabla = "#inv_Resistencias";
              break;
            case "ot":
              var id_tabla = "#inv_Otros";
              break;
          }
        
        if(tabla_previa){
          $(tabla_previa).addClass('d-none');
          console.log(tabla_previa);
        }
        $(id_tabla).removeClass('d-none');
        //console.log(id_tabla);
        tabla_previa = id_tabla;
        
      });
      }



      if ($(window).width() < 768) {
      var tabla_previa;
      var id_tabla;
      $('.lista-componentes>li>a').on("click", function(){
          console.log($(this).attr("id"));
          
          var id_opcion = $(this).attr("id");
          //id_opcion = "#"+id_opcion;
          console.log(id_opcion);
          switch(id_opcion){
            case "cc":
              id_tabla = "#inv_Complejos";
              break;
            case "ca":
              id_tabla = "#inv_Cables";
              break;
            case "se":
              id_tabla = "#inv_Sensores";
              break;
            case "le":
              id_tabla = "#inv_LED";
              break;
            case "tr":
              id_tabla = "#inv_Transitores";
              break;
            case "co":
              id_tabla = "#inv_Condensadores";
              break;
            case "di":
              id_tabla = "#inv_Diodos";
              break;
            case "re":
              id_tabla = "#inv_Resistencias";
              break;
            case "ot":
              id_tabla = "#inv_Otros";
              break;
          }
        
        if(tabla_previa){
          $(tabla_previa).addClass('d-none');
          console.log(tabla_previa);
        }
        $('.componentes').addClass('d-none');
        $(id_tabla).removeClass('d-none');
        //$('#volver').removeClass('d-none');
        $('i').removeClass('d-none');
        //console.log(id_tabla);
        tabla_previa = id_tabla;
      });

      $('i').click(function(){
        $(id_tabla).addClass('d-none');
        $('i').addClass('d-none');
        $('.componentes').removeClass('d-none');

      });
      }
      
    });


  </script>
</body>

</html>