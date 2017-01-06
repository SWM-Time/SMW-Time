<?php

include_once 'conexion.php';    
session_start();
$usuario = $_SESSION['usuario'];     
if (!isset($usuario)) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}


//guardamos en un array multidimensional todos los datos de la consulta
$i=0;
$tabla = "";

$resultadoMarcas = $conexion->query("SELECT * FROM tiempos t JOIN usuarios u ON u.idUsuario= t.idUsuario JOIN piscinas p ON p.idPiscina= t.idPiscina JOIN pruebas pr ON pr.idPrueba=t.idPrueba JOIN tipopiscina tp ON tp.idTipoPiscina=t.idTipoPiscina where usuario ='".$usuario."'");

                    while ($registroMarcas = $resultadoMarcas->fetch()) {
                        $tabla.= '{"prueba":"'.$registroMarcas["prueba"].'", "marca":"'.$registroMarcas["tiempo"].'", "fecha":"'.$registroMarcas["fecha"].'", "tipo_piscina":"'.$registroMarcas["tipoPiscina"].'", "piscina":"'.$registroMarcas["piscina"].'"},';

                        $i++;
                    }

                    $tabla = substr($tabla,0, strlen($tabla)-1);

                    echo '{"data":['.$tabla.']}';

?>