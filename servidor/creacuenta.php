<?php
include 'soporte.php';

try {
  $conectaBD = new PDO($bdDSN,$bdUsuario,$bdPassword);
}
catch(PDOException $e) {
  print "<p style='color:red'>No se puede conectar con la base de datos: ".$e->getMessage()."</p><br>";
  die();
}

$sqli="INSERT INTO usuarios(nombre,apellidos,dni,email,contraseña)
       VALUES(?,?,?,?,?)";

$sqli_prepare = $conectaBD->prepare($sqli);
$sqli_prepare->bindParam(1,$_POST["nombre"]);
$sqli_prepare->bindParam(2,$_POST["apellidos"]);
$sqli_prepare->bindParam(3,$_POST["dni"]);
$sqli_prepare->bindParam(4,$_POST["email"]);
$sqli_prepare->bindParam(5,$_POST["contrasena"]);

try {
  $sqli_prepare->execute();
}
catch (PDOException $e) {
  echo 'Ha habido un error en la base de datos';
  echo 'ERROR: $e';
  die();
}

?>