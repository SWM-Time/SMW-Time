var e = [];
 e[0]  = [29,19,19,19,19,19,29,19,19];
 e[1]  = [29,19,19,19,19,19,29,19,19];
 e[2]  = [29,19,19,19,19,19,29,19,19];
 e[3]  = [29,19,19,19,19,19,29,19,19];
 e[4]  = [29,19,19,19,19,19,29,19,19];
var m = [];
 m[0]  = [ 70,160,340, 720,1570,2950,280,640,1360];
 m[1]  = [110,250,570,   0,   0,   0,  0,  0,   0];
 m[2]  = [ 80,230,600,   0,   0,   0,  0,  0,   0];
 m[3]  = [ 30,130,310,   0,   0,   0,  0,  0,   0];
 m[4]  = [  0,  0,490,1000,   0,   0,290,770,   0];
var f = [];
f[0]   = [ 40,100,240, 520,1190,2230,160,400, 960];
f[1]   = [100,220,570,   0,   0,   0,  0,  0,   0];
f[2]   = [ 60,200,450,   0,   0,   0,  0,  0,   0];
f[3]   = [ 30, 80,240,   0,   0,   0,  0,  0,   0];
f[4]   = [  0,  0,310, 750,   0,   0,230,600,   0];

function darformato(t) {
    minutos = Math.floor(t / 6000);
    segundos = Math.floor((t - (minutos * 6000)) / 100);
    centesimas = t - (minutos * 6000) - (segundos * 100);
   
    minutos = (minutos<10 && minutos > -1)?"0"+minutos:minutos;
    segundos = (segundos<10 && segundos > -1)?"0"+segundos:segundos;
    centesimas = (centesimas<10 && centesimas > -1)?"0"+centesimas:centesimas;

    return minutos+":"+segundos+"."+centesimas+"<br \/>";
}
function convertir(form) {
    var tiempo = 0;
    var minutos = 0;
    var segundos = 0;
    var centesimas = 0;
    var tiempo50M=0,tiempo50E=0,tiempo25M=0,tiempo25E=0;
    var salida = "";
   
    tiempo = (isNaN(parseInt(form.minutos.value,10))?0:parseInt(form.minutos.value,10) * 6000)
            + (isNaN(parseInt(form.segundos.value,10))?0:parseInt(form.segundos.value,10) * 100)
            + (isNaN(parseInt(form.centesimas.value,10))?0:parseInt(form.centesimas.value,10));

    if (document.getElementById("crono_0").checked) {  
        if (document.getElementById("piscina_1").checked) {
            if (document.getElementById("sexo_0").checked) {
                tiempo50M = tiempo + m[form.estilo.value][form.prueba.value];
                tiempo50E = tiempo + m[form.estilo.value][form.prueba.value] + e[form.estilo.value][form.prueba.value];
                tiempo25M = tiempo;
                tiempo25E = tiempo + e[form.estilo.value][form.prueba.value];
            }else { 
                tiempo50M = tiempo + f[form.estilo.value][form.prueba.value];
                tiempo50E = tiempo + f[form.estilo.value][form.prueba.value] + e[form.estilo.value][form.prueba.value];
                tiempo25M = tiempo;
                tiempo25E = tiempo + e[form.estilo.value][form.prueba.value];
            }
        }else {
            if (document.getElementById("sexo_0").checked) {
                tiempo50M = tiempo;
                tiempo50E = tiempo + e[form.estilo.value][form.prueba.value];
                tiempo25M = tiempo - m[form.estilo.value][form.prueba.value];
                tiempo25E = tiempo - m[form.estilo.value][form.prueba.value] + e[form.estilo.value][form.prueba.value];
            }else {
                tiempo50M = tiempo;
                tiempo50E = tiempo + e[form.estilo.value][form.prueba.value];
                tiempo25M = tiempo - f[form.estilo.value][form.prueba.value];
                tiempo25E = tiempo - f[form.estilo.value][form.prueba.value] + e[form.estilo.value][form.prueba.value];
            }
        }
    }else {
        if (document.getElementById("piscina_1").checked) {
            if (document.getElementById("sexo_0").checked) {
                tiempo50M = tiempo + m[form.estilo.value][form.prueba.value] - e[form.estilo.value][form.prueba.value];
                tiempo50E = tiempo + m[form.estilo.value][form.prueba.value];
                tiempo25M = tiempo - e[form.estilo.value][form.prueba.value];
                tiempo25E = tiempo;
            }else {
                tiempo50M = tiempo + f[form.estilo.value][form.prueba.value] - e[form.estilo.value][form.prueba.value];
                tiempo50E = tiempo + f[form.estilo.value][form.prueba.value];
                tiempo25M = tiempo - e[form.estilo.value][form.prueba.value];
                tiempo25E = tiempo;
            }
        }else {
            if (document.getElementById("sexo_0").checked) {
                tiempo50M = tiempo - e[form.estilo.value][form.prueba.value];
                tiempo50E = tiempo;
                tiempo25M = tiempo - m[form.estilo.value][form.prueba.value] - e[form.estilo.value][form.prueba.value];
                tiempo25E = tiempo - m[form.estilo.value][form.prueba.value];
            }else {
                tiempo50M = tiempo - e[form.estilo.value][form.prueba.value];
                tiempo50E = tiempo;
                tiempo25M = tiempo - f[form.estilo.value][form.prueba.value] - e[form.estilo.value][form.prueba.value];
                tiempo25E = tiempo - f[form.estilo.value][form.prueba.value];
            }
        }
    }
    document.getElementById("salida1").innerHTML = darformato(tiempo50M);
    document.getElementById("salida2").innerHTML = darformato(tiempo50E);
    document.getElementById("salida3").innerHTML = darformato(tiempo25M);
    document.getElementById("salida4").innerHTML = darformato(tiempo25E);
}