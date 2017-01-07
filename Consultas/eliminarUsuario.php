<?php
include_once 'conexion.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$nadador= $_REQUEST['idUsuario'];

/*$consulta = $conexion->prepare = "DELETE FROM `usuarios` WHERE `idUsuario` = $nadador ";
var_dump($nadador);
var_dump($consulta);
//$consulta->bindParam(':nadador', $nadador);   
$consulta->execute();*/

$sqlInsert = 'DELETE FROM `usuarios` WHERE `idUsuario` = :nadador ';
$preparedStatement = $conexion->prepare($sqlInsert);
$preparedStatement->execute(array(':nadador' => $nadador));

?>

