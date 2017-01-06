<?php
include '../SMW-Time/utiles.php';
$caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
            $numerodeletras=10; //numero de letras para generar el texto
            $pass = ""; //variable para almacenar la cadena generada
            for($i=0;$i<$numerodeletras;$i++){
                $pass .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres
                entre el rango 0 a Numero de letras que tiene la cadena */
            }
echo $pass;
echo "</br>";
echo md5($pass);
?>