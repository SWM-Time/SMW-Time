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

$resultadoMarcas = $conexion->query("SELECT * FROM usuarios");
                    while ($registroMarcas = $resultadoMarcas->fetch()) {
                        $tabla.= '{"idUsuario":"'.$registroMarcas["email"].'", "usuario":"'.$registroMarcas["usuario"].'", "pass":"'.$registroMarcas["fnac"].'", "nombre":"'.$registroMarcas["nombre"].'", "apellido1":"'.$registroMarcas["apellido1"].'", "apellido2":"'.$registroMarcas["apellido2"].'"},';
                        $i++;
                    }

                    $tabla = substr($tabla,0, strlen($tabla)-1);
                    echo '{"data":['.$tabla.']}';
?>