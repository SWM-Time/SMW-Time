<?php

include_once 'conexion.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$piscina= $_POST['piscina'];


$consulta = $conexion->prepare("INSERT INTO piscinas"
        . "(piscina) "
        . "VALUES (:piscina)");
$consulta->bindParam(":piscina", $piscina );
$consulta->execute();
header('Location: editarMarcas');
?>
