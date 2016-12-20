<?php

class utiles {

    //Devulve fecha en formato dd-mm-YYYY
    public function formatFecha($datetime, $sep = '/') {
        $dia = substr($datetime, 8, 2);
        $mes = substr($datetime, 5, 2);
        $ano = substr($datetime, 0, 4);
        if ($dia && $mes && $ano) {
            return $dia . $sep . $mes . $sep . $ano;
        } else {
            return null;
        }
    }

    //Devuelve fecha en formato YYYY-mm-dd
    public function formatFechaDB($datetime) {
        $dia = substr($datetime, 0, 2);
        $mes = substr($datetime, 3, 2);
        $ano = substr($datetime, 6, 4);
        if ($dia && $mes && $ano) {
            return $ano . "/" . $mes . "/" . $dia;
        } else {
            return null;
        }
    }

    //Valida una fecha en formato dd-mm-YYYY
    public function validaFecha($datetime) {
        $res = array();
        if (preg_match('/(\d{2})-(\d{2})-(\d{4})/', $datetime, $res)) {
            if (((int) $res[1]) > 0 && ((int) $res[1]) < 32 && ((int) $res[2]) > 0 &&
                    ((int) $res[2]) < 13 && ((int) $res[3]) > 1500 && ((int) $res[3]) < 3000) {
                return true;
            }
        }
        return false;
    }
    
    public static function generaPass(){
        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
            $numerodeletras=10; //numero de letras para generar el texto
            $pass = ""; //variable para almacenar la cadena generada
            for($i=0;$i<$numerodeletras;$i++){
                $pass .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres
                entre el rango 0 a Numero de letras que tiene la cadena */
            }
            echo $pass;
    }
    
    public function formatTiempoDB($time) {
        return "00:".$time;
    }

}

?>
