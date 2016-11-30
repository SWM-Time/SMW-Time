<?php

include_once 'conexion.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}
//if( isset($_GET['ver']) ){
    
$sexo = $_POST['sexo'];
$prueba = $_POST['prueba'];

$resultadoMarcas = $conexion->query("SELECT * FROM tiempos INNER JOIN "
        . "usuarios ON usuarios.idUsuario= tiempos.idUsuario WHERE sexo = ".$sexo." AND idPrueba=".$prueba);
                    while ($registroMarcas = $resultadoMarcas->fetch()) {
                        echo "<p>".$registroMarcas['usuario']." - ".$registroMarcas['tiempo']."</p> \n";
                    }
//}
?>