<?php

/* Datos de conexión con la base de datos de MariaDB */

$bdServidor = "localhost";      // Servidor de bases de datos
$bdNombre = "Arman";            // Nombre de base de datos
//$dbDSN = "mysql:host=localhost;dbname=Arman"; // DSN para emplear PDO.
$bdDSN = "mysql:host=".$bdServidor.";dbname=". $bdNombre .";charset=UTF8"; // DSN para emplear PDO.
$bdUsuario = "admin";           // Usuario de base de datos 
$bdPassword = "Armando_jaleo";  // Contraseña de usuario de BD




/* Se crea la sesion de usuario cuando de introduce usuario y contraseña */
function iniciarSesion($usuario,$password) {

  global $bdDSN, $bdUsuario, $bdPassword;

  try {
    $conexionBD = new PDO($bdDSN, $bdUsuario, $bdPassword);
  } 
  catch (PDOException $e) {
      print "<p style='color:red'>No se puede conectar con la base de datos: ".$e->getMessage()."</p><br>";
      die();
  }

  $sql="SELECT nombre,contraseña FROM usuarios WHERE nombre='".$usuario."' AND contraseña='".$password."'";

  $sql_prepare = $conexionBD->prepare($sql);
  $sql_prepare->execute();
  $resultado = $sql_prepare->fetch(PDO::FETCH_OBJ);
  
  $nombreDB = $resultado->nombre;
  $contraDB = $resultado->contraseña;
  $dniDB = $resultado->dni;

  if($nombreDB == $usuario and $contraDB == $password) {
    session_start();
    $_SESSION["usuarioSesion"] = $usuario;
    header("Location: comienzo.php");
  }
  else {
    echo 'Nombre de usuario o contraseña incorrectos';
  }
  $conexionBD = null;

}



 /** $BD base de datos de la cual queremos conocer sus columnas. */
function leerNombreTablas($BD) {  
                                    
  global $bdDSN, $bdUsuario, $bdPassword;
  
  try {
    $conDB = new PDO($bdDSN, $bdUsuario, $bdPassword);
  }
  catch(PDOException $e) {
    print "Error en la conexión a la BD: ".$e->get_message();
    die();
  }

  $consultasql = "SELECT table_name AS tabla 
                  FROM information_schema.tables 
                  WHERE table_schema='".$BD."';";

  $resultado = $conDB->query($consultasql)->fetchAll(PDO::FETCH_COLUMN);

  return $resultado;

  $resultado = null;
  $conDB = null;

}



/** Obtiene un Array que a su vez contiene otro array que a 
 * su vez contiene los datos de cada tabla como array asociativo
 * correspondiente al usuario con dni $dniusu*/
function obtenerDatosTabla($nombre_tabla, $nombre_bd, $dniusu) {
  global $bdDSN, $bdUsuario, $bdPassword;
  
  try {
    $conexion_tabla = new PDO($bdDSN, $bdUsuario, $bdPassword);
  }
  catch(PDOException $e) {
    print "Error en la conexión a la BD: ".$e->get_message();
    die();
  }

  $consql =  "SELECT * FROM ".$nombre_tabla." WHERE id_dniusu='".$dniusu."';";

  //echo $nombre_tabla."<br>";
  //echo $nombre_bd."<br>";
  //echo $dniusu."<br>";
  //echo $consql."<br>";
  //echo $conexion_tabla->query($consql);

  //$cadea = print_r($conexion_tabla->query($consql));
  //echo $cadea."<br>";

  //$res = $conexion_tabla->query($consql)->fetchAll();
  $res = $conexion_tabla->query($consql);
  
  return $res;

  $res = null;
  $conexion_tabla = null;
}



/* Cargar en tabla los datos obtenidos de la base de datos */
/* y contenidos en un array asociativo */

$items; // Array asociativo

function mostrarDatos($items) {
  foreach($items as $k=>$v) {
    if ($k!="id_dniusu") {  
      echo '<tr><td>'.$k.'</td><td>'.$v.'</td></tr>';
    }
  }
}

/*************************/
/* Base de datos MongoDB */
/*************************/

/* Nombre de la base de datos MongoDB */
//$mongodb = 'proyar';
$mongodb = 'armanpruebas';

/**
 * Extrae datos de cada elemento de un objeto cursor y
 * los almacena en un array.
 * Innecesario (reinvencion de la rueda): 
 * $document = json_decode(json_encode($fila),true);
 * hace exactamente lo mismo ($document es un array).
 */
function asignarDatosProyecto($fila) {
  $datosProy = [];

  $datosProy["id"] = $fila->_id;
  $datosProy["Autor"] = $fila->Autor;
  $datosProy["Finalizado"] = $fila->Finalizado;
  $datosProy["Titulo"] = $fila->Titulo;
  $datosProy["Descripcion"] = $fila->Descripcion;
  $datosProy["EsquemaElectrico"] = $fila->EsquemaElectrico;
  $datosProy["Codigo"] = $fila->Codigo;
  $datosProy["Resultado"] = $fila->Resultado;
  // Componentes utilizados en el proyecto
  foreach ($fila->Componentes as $k => $v)  {
    $datosProy["Componentes"][$k] = $v;
  }
  // Etapas del proyecto (cada elemento del array es un objeto)
  $n=0;
  foreach ($fila->Etapas as $et) {
    $datosProy["Etapas"][$n] = $et;
    $n++;
  }


  return $datosProy;
}


// function creaProyecto($array_proyecto) {
//   foreach($array_proyecto as $pro) {
//     echo '<section><h3>';
//     echo $pro["titulo"];
//     echo '</h3><hr><div id="preparacion" class="card">'
//          .'<div class="card-header">Esquema y componentes</div>'
//          .' <div class="card-body"><p class="card-title">Esquema</p>';
//     echo '<img class="card-img-top" src="'.echo $pro["EsquemaElectrico"]
//          .'" alt="Esquema eléctrico"><p>'.echo $pro["Descripcion"]
//          .'</p><p class="card-title">Componentes</p>';
    
//     $claves = array_keys($pro["Componentes"]);
//     echo "<table class='table table-bordered table-hover table-sm'>";
//     echo "<tbody>";
//     foreach ($claves as $cla) {
//       print("<tr><td>".$cla."</td>");
//       print("<td class='dato'>".$pro['Componentes'][$cla]."</td></tr>");
//     }
//     echo "</tbody>";
//     echo "</table>";

//     echo '<button class="btn btn-codigo">C&oacute;digo</button></div>';

//     foreach($pro["Etapas"] as $et){
//       print("<div class='card'>");
//       print("<div class='card-header'>");
//       // echo $et->Nombre;
//       echo $et["Nombre"];
//       print("</div>");
//       print("<div class='card-body'>");     
//       echo '<img class="img-fluid" style="float:left; padding-right:10px" src="';
//       echo $et["Imagen"];
//       echo '" alt="imagen">';
//       echo '<p class="text-justify">';
//       echo $et["Comentario"];
//       echo '</p></div></div>';
//     }

//     echo '<div class="card"><div class="card-header"><p>Resultado final</p>'
//         .'</div><div class="card-body"><video width="320" height="240"'.
//         .' controls src="video/';
//     echo $pro["Resultado"];
//     echo '"></video></div></div></section>';
//   }
//}






















?>