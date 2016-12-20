<?php
        /***************CONEXION A LA BD********************/
        $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        //Realizamos una conexión básico pdo        
        $conexion = new PDO('mysql:host=localhost; dbname=swm-time-oli', 'root', '', $opciones);
        if ($conexion) {
            //echo "<h2>Conexión realizada satisfactoriamente</h2></br>";
        } else {
            echo "<h2>No se ha conectado</h2></br>";
        }
        /****************************************************/
?>
