<?php

include_once 'conexion.php';
include '../utiles.php';

session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}

$nadador= htmlspecialchars($_POST['nadador']);
$prueba= htmlspecialchars($_POST['prueba']);
$fechaMarca= utiles::formatFechaDB(htmlspecialchars($_POST['fechaMarca']));
$tipoPiscina= htmlspecialchars($_POST['tipoPiscina']);
$tipoCompeticion= htmlspecialchars($_POST['tipoCompeticion']);
$piscina= htmlspecialchars($_POST['piscina']);
$temporada = htmlspecialchars($_POST['temporada']);
$marca = utiles::formatTiempoDB(htmlspecialchars($_POST['marca']));
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

