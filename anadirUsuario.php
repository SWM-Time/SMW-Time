<?php

include_once 'conexion.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$usuario= $_POST['usuario'];
$pass= $_POST['pass'];
$nombre = $_POST['nombre'];
$apellido1= $_POST['apellido1'];
$apellido2= $_POST['apellido2'];
$rol= $_POST['rol'];
$fnac= $_POST['fnac'];
$categoria = $_POST['categoria'];
$sexo= $_POST['sexo'];
$email= $_POST['email'];



$consulta = $conexion->prepare("INSERT INTO usuarios "
        . "(usuario, pass, nombre, apellido1, apellido2, "
        . "idRol, fnac, idCategoria, sexo, email) "
        . "VALUES (:usuario, :pass, :nombre, :apellido1, :apellido2, "
        . ":idRol, :fnac, :idCategoria, :sexo, :email)");
$consulta->bindParam(":usuario", $usuario );
$consulta->bindParam(":pass",$pass );
$consulta->bindParam(":nombre", $nombre);
$consulta->bindParam(":apellido1", $apellido1);
$consulta->bindParam(":apellido2", $apellido2);
$consulta->bindParam(":idRol", $rol);
$consulta->bindParam(":fnac", $fnac);
$consulta->bindParam(":idCategoria", $categoria);
$consulta->bindParam(":sexo", $sexo);
$consulta->bindParam(":email",$email);
$consulta->execute();
header('Location: editarMarcas.php');
?>

