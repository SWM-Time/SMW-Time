<?php
include_once 'conexion.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$marca= $_REQUEST['idTiempo'];

$sqlInsert = 'DELETE FROM `tiempos` WHERE `idTiempo` = :marca ';
$preparedStatement = $conexion->prepare($sqlInsert);
$preparedStatement->execute(array(':marca' => $marca));

?>

