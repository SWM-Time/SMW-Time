<?php

include_once 'conexion.php';    
session_start();
            
if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}


//guardamos en un array multidimensional todos los datos de la consulta
$i=0;
$tabla = "";

//http://vertutoriales.dkreativo.es/crear-datatable-con-jquery-cargando-una-tabla-mysql-con-php/
$resultadoMarcas = $conexion->query("SELECT * FROM tiempos t JOIN usuarios u ON u.idUsuario= t.idUsuario JOIN piscinas p ON p.idPiscina= t.idTipoPiscina JOIN pruebas pr ON pr.idPrueba=t.idPrueba JOIN tipopiscina tp ON tp.idTipoPiscina=t.idTipoPiscina ");
//var_dump($resultadoMarcas);
//$resultadoMarcas->execute();

                    while ($registroMarcas = $resultadoMarcas->fetch()) {
                        $tabla.= '{"usuario":"'.$registroMarcas["usuario"].'", "prueba":"'.$registroMarcas["prueba"].'", "marca":"'.$registroMarcas["tiempo"].'", "fecha":"'.$registroMarcas["fecha"].'", "tipo_piscina":"'.$registroMarcas["tipoPiscina"].'", "piscina":"'.$registroMarcas["piscina"].'"},';
                        //$tabla.= "{'usuario':'".$registroMarcas['usuario']."', 'prueba':'".$registroMarcas['idPrueba']."', 'marca':'".$registroMarcas['tiempo']."', 'fecha':'".$registroMarcas['fecha']."', 'tipo_piscina':'".$registroMarcas['idTipoPiscina']."', 'piscina':'".$registroMarcas['idPiscina']."'}";                        
                        //var_dump($tabla);
                        $i++;
                    }

                    $tabla = substr($tabla,0, strlen($tabla)-1);
                    //$tabla = $tabla;

                    echo '{"data":['.$tabla.']}';
                    //$aa = json_encode($tabla);
                    //echo json_encode($tabla);
                    //echo '{"data":['.$aa.']}';
                    



?>