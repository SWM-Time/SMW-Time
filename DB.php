<?php

class DB {

    function anadirPiscina() {

        $piscina = $_POST['piscina'];


        $consulta = $conexion->prepare("INSERT INTO piscinas"
                . "(piscina) "
                . "VALUES (:piscina)");
        $consulta->bindParam(":piscina", $piscina);
        $consulta->execute();
        //header('Location: editarMarcas.php');
    }

}

?>
