<?php

class utiles {

    //Devulve fecha en formato dd-mm-YYYY
    function formatFecha($datetime, $sep = '/') {
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
    function formatFechaDB($datetime) {
        $dia = substr($datetime, 0, 2);
        $mes = substr($datetime, 3, 2);
        $ano = substr($datetime, 6, 4);
        if ($dia && $mes && $ano) {
            return $ano . "/" . $mes . "/" . $dia;
        }else{
            return null;
        }
    }
}
