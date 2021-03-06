<?php

include_once 'conexion.php';
include '../utiles.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$new_usuario= htmlspecialchars($_POST['new_usuario']);
$pass= htmlspecialchars($_POST['pass']);
$nombre = htmlspecialchars($_POST['nombre']);
$apellido1= htmlspecialchars($_POST['apellido1']);
$apellido2= htmlspecialchars($_POST['apellido2']);
$rol= htmlspecialchars($_POST['rol']);
$fnac= utiles::formatFechaDB(htmlspecialchars($_POST['fnac']));
$categoria = htmlspecialchars($_POST['categoria']);
$sexo= htmlspecialchars($_POST['sexo']);
$email= htmlspecialchars($_POST['email']);

$consulta = $conexion->prepare("INSERT INTO usuarios "
        . "(usuario, pass, nombre, apellido1, apellido2, "
        . "idRol, fnac, idCategoria, sexo, email) "
        . "VALUES (:usuario, :pass, :nombre, :apellido1, :apellido2, "
        . ":idRol, :fnac, :idCategoria, :sexo, :email)");
$consulta->bindParam(":usuario", $new_usuario );
$consulta->bindParam(":pass",md5($pass) );
$consulta->bindParam(":nombre", $nombre);
$consulta->bindParam(":apellido1", $apellido1);
$consulta->bindParam(":apellido2", $apellido2);
$consulta->bindParam(":idRol", $rol);
$consulta->bindParam(":fnac", $fnac);
$consulta->bindParam(":idCategoria", $categoria);
$consulta->bindParam(":sexo", $sexo);
$consulta->bindParam(":email",$email);

/*
var_dump($new_usuario."<br>");
var_dump($pass."<br>");
var_dump($nombre."<br>");
var_dump($apellido1."<br>");
var_dump($apellido2."<br>");
var_dump($rol."<br>");
var_dump($fnac."<br>");
var_dump($categoria."<br>");
var_dump($sexo."<br>");
var_dump($email."<br>");
var_dump($consulta);
var_dump(debug_backtrace());
*/
$consulta->execute();


//die;
header('Location: ../usuarios.php');
?>

