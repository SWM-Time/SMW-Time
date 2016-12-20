<?php

include_once 'conexion.php';
include '../utiles.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$nadador= $_POST['nadador'];
$prueba= $_POST['prueba'];
$fechaMarca= utiles::formatFechaDB($_POST['fechaMarca']);
$tipoPiscina= $_POST['tipoPiscina'];
$tipoCompeticion= $_POST['tipoCompeticion'];
$piscina= $_POST['piscina'];
$temporada = $_POST['temporada'];
$marca = utiles::formatTiempoDB($_POST['marca']);
//$marca= $_POST['marca'];


$consulta = $conexion->prepare("INSERT INTO tiempos "
        . "(idUsuario, idPrueba, idTipoPiscina, fecha, idPiscina, "
        . "idTemporada, idTipoCompeticion, tiempo) "
        . "VALUES (:nadador, :prueba, :tipoPiscina, :fechaMarca, "
        . ":piscina, :temporada, :tipoCompeticion, :marca)");
$consulta->bindParam(":nadador", $nadador );
$consulta->bindParam(":prueba",$prueba );
$consulta->bindParam(":tipoPiscina", $tipoPiscina);
$consulta->bindParam(":fechaMarca", $fechaMarca);
$consulta->bindParam(":piscina", $piscina);
$consulta->bindParam(":temporada", $temporada);
$consulta->bindParam(":tipoCompeticion", $tipoCompeticion);
$consulta->bindParam(":marca", $marca);
$consulta->execute();
header('Location: ../editarMarcas.php');
?>

