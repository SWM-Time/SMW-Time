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
$fnac= $_POST['fnac'];
$email= $_POST['email'];



$consulta = $conexion->prepare("UPDATE usuarios SET"
        . "'usuario'= :usuario, 'pass'= :pass, 'nombre'= :nombre, 'apellido1'= :apellido1"
        . ", 'apellido2'= :apellido2, 'fnac'= :fnac, 'email'= :email");
$consulta->bindParam(":usuario", $usuario );
$consulta->bindParam(":pass", md5($pass) );
$consulta->bindParam(":nombre", $nombre);
$consulta->bindParam(":apellido1", $apellido1);
$consulta->bindParam(":apellido2", $apellido2);
$consulta->bindParam(":fnac", $fnac);
$consulta->bindParam(":email",$email);
$consulta->execute();
header('Location: perfilUsuario.php');
?>