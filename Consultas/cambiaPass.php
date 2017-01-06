<?php

include_once 'conexion.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$usuario= $_SESSION['usuario'];
$pass1= htmlspecialchars($_POST['pass1']);


$consulta = $conexion->prepare("UPDATE usuarios SET pass = :pass WHERE usuario = :usuario");
$consulta->bindParam(":usuario", $usuario );
$consulta->bindParam(":pass", md5($pass1));
//die;
$consulta->execute();

?>