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


?>