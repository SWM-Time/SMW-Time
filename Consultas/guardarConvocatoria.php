<?php

include_once 'conexion.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}
$temp = $_FILES['convocatoria']['tmp_name'];
$tipoCompeticion = htmlspecialchars($_POST['tipoCompeticion']);
$piscina= htmlspecialchars($_POST['piscina']);
$categoria= htmlspecialchars($_POST['categoria']);
$fecha= htmlspecialchars($_POST['fecha']);
$hora= htmlspecialchars($_POST['hora']);
$temporada= htmlspecialchars($_POST['temporada']);
$tipoPiscina= htmlspecialchars($_POST['tipoPiscina']);
$directorio = "Convocatorias";
$convocatoria = $_FILES['convocatoria']['name'];
$url = "../" .$directorio . "/" . $convocatoria;
$urlBD = $directorio . "/" . $convocatoria;
if ($_FILES["convocatoria"]["type"] == "application/pdf"){
if (move_uploaded_file($temp,$url)) {
    echo "hola";
}
    $consulta = $conexion->prepare( "INSERT INTO convocatorias "
            . "(url, fecha, hora, idPiscina, idTipoPiscina, "
            . "idTemporada, idTipoCompeticion, idCategoria) "
            . "VALUES (:url,:fecha, :hora, :idPiscina, :idTipoPiscina,"
            . ":idTemporada, :idTipoCompeticion, :idCategoria)");
    $consulta->bindParam(":url", $urlBD);
    $consulta->bindParam(":fecha", $fecha);
    $consulta->bindParam(":hora", $hora);
    $consulta->bindParam(":idPiscina", $piscina);
    $consulta->bindParam(":idTipoPiscina", $tipoPiscina);
    $consulta->bindParam(":idTemporada", $temporada);
    $consulta->bindParam(":idTipoCompeticion", $tipoCompeticion);
    $consulta->bindParam(":idCategoria", $categoria);
    $consulta->execute();
    header('Location: ../convocatorias.php');
    //echo "El archivo se ha subido correctamente";
}else{
    
    echo 'SOLO SE ADMITEN ARCHIVOS PDF</br>';
    echo '<a href="../convocatorias.php">VOLVER</a>';
    die;
}

?>

