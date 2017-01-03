<?php

include_once 'conexion.php';
include '../utiles.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}
    
$sexo = $_POST['sexo'];
$prueba = $_POST['prueba'];
$piscina = $_POST['piscina'];
if($piscina == 1){
    $piscina = "1 OR idTipoPiscina = 2";
}elseif ($piscina == 2) {
    $piscina = "3 OR idTipoPiscina = 4";
}

echo '<table class= "table table-hover">
    <thead>
      <tr>
        <th>Nadador</th>
        <th>Marca</th>
        <th>Fecha</th>
      </tr>
    </thead>';
$resultadoMarcas = $conexion->query("SELECT usuario,nombre, apellido1, apellido2 , MIN(tiempo) as min_tiempo, fecha, idTipoPiscina FROM tiempos INNER JOIN usuarios ON usuarios.idUsuario= tiempos.idUsuario WHERE idPrueba=".$prueba." AND sexo = ".$sexo." AND (idTipoPiscina =".$piscina.") GROUP BY usuarios.usuario ORDER BY min_tiempo ASC");
                    while ($registroMarcas = $resultadoMarcas->fetch()) {
                        $fecha = utiles::formatFecha($registroMarcas['fecha']);
                        echo "<tbody>
                                    <tr><td>".$registroMarcas['nombre']." ".$registroMarcas['apellido1']." ".$registroMarcas['apellido2']."</td><td> ".substr($registroMarcas['min_tiempo'], 3, 10)." </td><td> ".$fecha."</td></tr>";
                    }
echo "</tbody></table>";    
?>