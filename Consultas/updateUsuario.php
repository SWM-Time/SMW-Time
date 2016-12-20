<?php

include_once 'conexion.php';
include '../utiles.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$usuario= $_SESSION['usuario'];
$nombre = $_POST['nombre'];
$apellido1= $_POST['apellido1'];
$apellido2= $_POST['apellido2'];
$fechaBuena = utiles::formatFechaDB($_POST['fnac']);
$email= $_POST['email'];


$consulta = $conexion->prepare("UPDATE usuarios SET"
        . "  nombre= :nombre, apellido1= :apellido1 "
        . ", apellido2= :apellido2, fnac= :fnac, email= :email WHERE usuario= :usuario");
$consulta->bindParam(":usuario", $usuario );
$consulta->bindParam(":nombre", $nombre);
$consulta->bindParam(":apellido1", $apellido1);
$consulta->bindParam(":apellido2", $apellido2);
$consulta->bindParam(":fnac", $fechaBuena);
$consulta->bindParam(":email",$email);
$consulta->execute();
//die;
header('Location: ../perfilUsuario.php');
?>