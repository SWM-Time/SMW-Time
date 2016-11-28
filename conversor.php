<!DOCTYPE html>
<html>
    <head>
        <title>Conversor</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/fonts.css">
        <!-- Versión compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
               
    </head>
    <body>
        <?php
            include_once 'conexion.php';    
            session_start();    
        ?>
        <div class="container" id="header">
            <div class="row" id="logo">
                <img src="imagenes/logos/crono_48.png">
            </div>
        </div>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">SMW-TIME</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li><a href="menuPrincipal.php">Mis tiempos</a></li>
                        <li><a href="ranking.php">Ranking</a></li>
                        <li class="active"><a href="conversor.php">Conversor</a></li>
                        <li><a href="convocatorias.php">Convocatorias</a></li>
                        <?php
                        $sql = $conexion->query("select idRol from usuarios where usuario = '".$_SESSION['usuario']."'");
                        $resultado = $sql->fetch();
                        $rol = $resultado[0];
                        if($rol[0] == 1 || $rol[0] == 2){
                            echo '<li><a href="editarMarcas.php">Editar marcas</a></li>';
                          }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="perfilUsuario.php"><span class="glyphicon glyphicon-user"></span> Hola <?php echo $_SESSION['usuario'];?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
<script type="text/javascript">
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
</script>
<div class="row">
    <div class="center-block">
        <h3>Datos de la prueba cuyo tiempo quieres convertir:</h3>
    </div>
</div>
<form method="post" action="#">
    <div class="form-group">
  <div align="center">    
      <div class="row" id="estilo-prueba">
          <div class="col-sm-6">
              <label for="estilo"><strong>Estilo</strong></label>
                <select name="estilo" size="1" id="estilo" class="form-control">
                    <option value="0">Libre</option>
                    <option value="1">Espalda</option>
                    <option value="2">Braza</option>
                    <option value="3">Mariposa</option>
                    <option value="4">Estilos</option>
                </select>
          </div>
          <div class="col-sm-6">
              <label for="prueba"><strong>Prueba</strong></label>
                <select name="prueba" size="1" id="prueba" class="form-control">
                    <option value="0">50</option>
                    <option value="1">100</option>
                    <option value="2">200</option>
                    <option value="3">400</option>
                    <option value="4">800</option>
                    <option value="5">1500</option>
                    <option value="6">4x50</option>
                    <option value="7">4x100</option>
                    <option value="8">4x200</option>
                </select>              
          </div>          
      </div>
    <br />
    
    <div class="row" id="selects">
        <div class="col-sm-4">
            <strong>Sexo</strong>
            <div class="radio">
                <label>
                    <input name="sexo" type="radio" id="sexo_0" value="M" checked="checked" />Masculino
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="sexo" value="F" id="sexo_1" />Femenino
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <strong>Piscina</strong>
            <div class="radio">
                <label>
                    <input name="piscina" type="radio" id="piscina_0" value="50" checked="checked" />50 m
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="piscina" value="25" id="piscina_1" />25 m
                </label>
            </div>
        </div>
        <div class="col-sm-4">
            <strong>Cronómetro</strong>
            <div class="radio">
                <label>
                    <input name="crono" type="radio" id="crono_0" value="M" checked="checked" />Manual
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="crono" value="E" id="crono_1" />Electrónico
                </label>
            </div>
        </div>
    </div>

    <br />
    <label for="minutos"><strong>Tiempo a convertir</strong></label> <em>(Ejemplo: 1:23.45)</em>
        <div class="form-inline">
    <input name="minutos" type="text" class="form-control" id="minutos" value="0" size="1" maxlength="2" />
    :
    <input name="segundos" type="text" class="form-control" id="segundos" value="00" size="1" maxlength="2" />
    .
    <input name="centesimas" type="text" class="form-control" id="centesimas" value="00" size="1" maxlength="2" />
        </div>
    
    <br />
    <input name="button" class="btn-default" type ="button" onclick="convertir(this.form)" value="Convertir tiempo" />
    <br />
    <br />
   <h4>Tiempo convertido, según piscina y crono:</h4>
    <table class="table table-striped">
        <thead>
  <tr>
    <th>Piscina y tipo de crono</th>
    <th>Resultado</th>
  </tr>
  </thead>
  <tr>
    <td style="border-top: 1px dotted #eee;">Piscina <strong>50 metros</strong>, cronómetro <strong>manual</strong>:</td>
    <td style="border-top: 1px dotted #eee; font-style:italic" id="salida1"></td>
  </tr>
  <tr>
    <td style="border-top: 1px dotted #eee;">Piscina <strong>50 metros</strong>, cronómetro <strong>electrónico</strong>:</td>
    <td style="border-top: 1px dotted #eee; font-style:italic" id="salida2"></td>
  </tr>
  <tr>
    <td style="border-top: 1px dotted #eee;">Piscina <strong>25 metros</strong>, cronómetro <strong>manual</strong>:</td>
    <td style="border-top: 1px dotted #eee; font-style:italic" id="salida3"></td>
  </tr>
  <tr>
    <td style="border-top: 1px dotted #eee;">Piscina <strong>25 metros</strong>, cronómetro <strong>electrónico</strong>:</td>
    <td style="border-top: 1px dotted #eee; font-style:italic" id="salida4"></td>
  </tr>
</table>
</form>
</div>
</div>
    </body>
    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
</html>
