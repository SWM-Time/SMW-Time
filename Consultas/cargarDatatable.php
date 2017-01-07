<?php

include_once 'conexion.php';    
session_start();
            
if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}
$usuario = $_SESSION['usuario'];

//guardamos en un array multidimensional todos los datos de la consulta
$i=0;
$tabla = "";

$resultadoMarcas = $conexion->query("SELECT idTiempo, u.usuario,  p.prueba, tiempo, fecha, tp.tipoPiscina,  ps.piscina FROM tiempos t JOIN usuarios u ON u.idUsuario = t.idUsuario JOIN pruebas p ON p.idPrueba = t.idPrueba JOIN piscinas ps ON ps.idPiscina = t.idPiscina JOIN tipopiscina tp ON tp.idTipoPiscina = t.idTipoPiscina");
                    while ($registroMarcas = $resultadoMarcas->fetch()) {
                        $tabla.= '{"idTiempo":"'.$registroMarcas["idTiempo"].'", "usuario":"'.$registroMarcas["usuario"].'", "prueba":"'.$registroMarcas["prueba"].'", "tiempo":"'.$registroMarcas["tiempo"].'", "fecha":"'.$registroMarcas["fecha"].'", "tipoPiscina":"'.$registroMarcas["tipoPiscina"].'", "piscina":"'.$registroMarcas["piscina"].'"},';
                        $i++;
                    }

                    $tabla = substr($tabla,0, strlen($tabla)-1);
                    echo '{"data":['.$tabla.']}';
?>