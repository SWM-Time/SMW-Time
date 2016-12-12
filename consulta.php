<?php

include_once 'conexion.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    die("Error - debe <a href='index.php'>identificarse</a>.<br />");
}
    
$sexo = $_POST['sexo'];
$prueba = $_POST['prueba'];
$piscina = $_POST['piscina'];

echo '<table class= "table table-hover">
    <thead>
      <tr>
        <th>Nadador</th>
        <th>Marca</th>
        <th>Fecha</th>
      </tr>
    </thead>';
$resultadoMarcas = $conexion->query("SELECT usuario , MIN(tiempo) as min_tiempo, fecha FROM tiempos INNER JOIN usuarios ON usuarios.idUsuario= tiempos.idUsuario WHERE idPrueba=".$prueba." AND idPiscina=".$piscina." GROUP BY usuario ORDER BY tiempo ASC");
                    while ($registroMarcas = $resultadoMarcas->fetch()) {
                        echo "<tbody>
                                    <tr><td>".$registroMarcas['usuario']." </td><td> ".substr($registroMarcas['min_tiempo'], 3, 10)." </td><td> ".$registroMarcas['fecha']."</td></tr>";
                    }
echo "</tbody></table>";    
?>