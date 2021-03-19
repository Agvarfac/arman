<!DOCTYPE html>
<html lang="gl_ES">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Banco de trabajo</title>
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
    />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="shortcut icon" href="img/Arman_logo_favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="css/cabecera.css" />
    <link rel="stylesheet" href="css/bt.css" />
  </head>
  <body>
     <nav class="navbar navbar-expand-sm fondomenu font-weight-bold"> 
    <img class="navbar-brand " src="img/Arman_logo32.png" alt="Logotipo de Arman">
    <ul class="navbar-nav">
      <li class="nav-item"><a class="nav-link text-white" href="inventario.php">Inventario</a></li>
      <li class="nav-item"><a class="nav-link text-white" href="catalogo.php">Cat&aacute;logo</a></li>
      <li class="nav-item"><a class="nav-link text-white activo" href="banco_trabajo">Banco de trabajo</a></li>
    </ul>
    <div class="navbar-text ml-sm-auto">
    <div class="navbar-text mr-sm-auto"></div>
      <a class="nav-link text-white" href="#">
        <?php
        session_start();
        echo $_SESSION["usuarioSesion"];
        ?>
      </a>
    </div>
  </nav>

    <div class="container bg-light">
      <div class="menu">
        <ul class="list-group list-group-horizontal justify-content-center">
          <a href="#"><li class="list-group-item" id="nuevop">Nuevo proyecto</li></a>
          <a href="#"><li class="list-group-item dropdown-toggle" id="editap" data-toggle="dropdown">Editar proyecto
            <div class="dropdown-menu" aria-labelledby="editap">
              <a href="#" class="dropdown-item" onclick=""> Un proyecto</a>
              <a href="#" class="dropdown-item" onclick=""> Otro proyecto</a>
              <a href="#" class="dropdown-item" onclick=""> Un tercer proyecto</a>
            </div>
          </li></a>
        </ul>
      </div>

      <div class="opciones">
        <ul class="list-group list-group-horizontal justify-content-center" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <a href="#"><li class="list-group-item" id="selinfo">Informaci&oacute;n del proyecto</li></a>
          <a href="#"><li class="list-group-item" id="seletapa">Etapas de desarrollo</li></a>
          <a href="#"><li class="list-group-item" id="selinicio">Inicio</li></a>
        </ul>
      </div>

      <div class="form-group row" id="informacion">      
        <form action="" method="post" id="inicio">
          <h2>Informaci&oacute;n del proyecto</h2>
          <hr />
          
          <label for="titulo" class="col-sm-5 col-form-label">Nombre del proyecto</label>
          <input type="text" name="titulo" id="titulo" />
          <br />
          
          <label for="texto" class="col-sm-5 col-form-label">Descripción</label>
          <textarea name="comentario" id="comentario" cols="30" rows="5"></textarea>
          <br /><br />
          
          <label for="eligeimagen" class="col-sm-5 col-form-label">Seleccione el esquema eléctrico:</label>
          <input type="file" name="eligeimagen" id="eligeimagen" />
          <br /><br />
          
          <label for="codigo" class="col-sm-5 col-form-label">Seleccione el fichero de código fuente</label>
          <input type="file" name="codigo" id="codigo" />
          <br /><br />

          <label for="video" class="col-sm-5 col-form-label">Seleccione fichero de video</label>
          <input type="file" name="video" id="video" />
          <br /><br />

          <label for="fin" class="col-sm-5 col-form-label">Finalizado?</label>
          <input type="checkbox" name="fin" id="fin" />
          <br /><br />

          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="reset" class="btn btn-warning">Descartar</button>
          <button type="reset" class="btn btn-danger" id="cancelar">Cancelar</button>

        </form>
      </div>
  
      <div class="form-group row" id="etapas" >
        <form action="" method="post" id="formetapa" class="">
          <h2>Etapas de desarrollo</h2>
          <hr />
          <label for="titulo" class="col-sm-4 col-form-label">Título de la etapa</label>
          <input type="text" name="titetapa" id="titetapa" />
          <br />
          <label for="comentario" class="col-sm-4 col-form-label">Comentario de la etapa</label>
          <textarea type="text" cols="30" rows="5" id="cometapa"></textarea>
          <br />
          <label for="img" class="col-sm-4 col-form-label">Seleccione fichero de imagen</label>
          <input type="file" name="img" id="img" />
          <br /><br />
          <button type="submit" class="btn btn-primary">Guardar</button>
          <button type="reset" class="btn btn-warning">Descartar</button>
          <button type="reset" class="btn btn-danger" id="cancelar">Cancelar</button>
        </form>
      </div>

      <!--<div class="form-group">
        <form action="" method="post" id="resultado">
          <h2>Resultado</h2>
          <hr />
          <label for="comentario">Comentario de la etapa</label>
          <textarea type="text" cols="30" rows="5" id="cometapa"></textarea>
          <br />
          <label for="img">Seleccione fichero de videoe</label>
          <input type="file" name="img" id="img" />
        </form>
      </div>-->
    </div>

    <script>
        $(document).ready(function(){
          
          // Inicio de pantalla
          $('#informacion').hide();
          $('#etapas').hide();
          $('.opciones').hide();

          $('#nuevop').click(function(){
            $('.menu').hide();
            $('.opciones').show();
          });
        
          $('#selinfo').click(function(){
            $('#informacion').show();
            $('#etapas').hide();
          })

          $('#seletapa').click(function(){
            $('#etapas').show();
            $('#informacion').hide();
          })

          $('#selinicio').click(function(){
            $('.opciones').hide();
            $('#informacion').hide();
            $('#etapas').hide();  
            $('.menu').show();
          });

        });
    </script>
  </body>
</html>
