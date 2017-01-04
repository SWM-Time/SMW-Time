<!DOCTYPE html>
<html>
    <head>
        <title>Puntos FINA</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="./imagenes/logos/favicon.png">
        <link rel="stylesheet" href="./css/fonts.css">

        <!-- VersiÃ³n compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/lumen.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">

    </head>
    <body>
        <?php
        include_once 'Consultas/conexion.php';
        include 'utiles.php';
        session_start();

        if (!isset($_SESSION['usuario'])) {
            die("Error - debe <a href='index.php'>identificarse</a>.<br />");
        }
        $resultadoUsuarios = $conexion->query("select idUsuario from usuarios where usuario='" . $_SESSION['usuario'] . "'");
        $idUsuario = $resultadoUsuarios->fetch();
        $foo = (int) $idUsuario[0];
        ?>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="glyphicon glyphicon-menu-down"></span>
                    </button>
                    <img alt="SWM-TIME" src="imagenes/cronos/crono48.png">
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="menuPrincipal.php">Marcas<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="menuPrincipal.php">Mejores marcas</a></li>
                                <li><a href="misMarcas.php">Mis marcas</a></li>
                            </ul>
                        </li>
                        <li><a href="ranking.php">Ranking</a></li>
                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="conversor.php">Calculadoras<span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="conversor.php">Conversor</a></li>
                                <li><a href="puntosFINA.php">Puntos FINA</a></li>
                            </ul>
                        </li>
                        <li><a href="convocatorias.php">Convocatorias</a></li>
                        <?php
                        $sql = $conexion->query("select idRol from usuarios where usuario = '" . $_SESSION['usuario'] . "'");
                        $resultado = $sql->fetch();
                        $rol = $resultado[0];
                        if ($rol[0] == 1 || $rol[0] == 2) {
                            echo '<li><a href="editarMarcas.php">Panel de control</a></li>';
                        }
                        ?>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="perfilUsuario.php"><span class="glyphicon glyphicon-user"></span> Hola <?php echo $_SESSION['usuario']; ?></a></li>
                        <li><a href="Consultas/logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <div class="row">
                <div align="center">
                    <h3>Puntos FINA</h3>
                </div>
            </div>
            <div align="center">   
            <form>
                <div class="form-group">
                    <label for="prueba"><strong>Prueba</strong></label>
                    <select id="prueba"  name="prueba" class="form-control">
                        <option value="01" selected>50m Libres</option>
                        <option value="02">100m Libres</option>
                        <option value="03">200m Libres</option>
                        <option value="04">400m Libres</option>
                        <option value="05">800m Libres</option>
                        <option value="06">1500m Libres</option>
                        <option value="07">50m Mariposa</option>
                        <option value="08">100m Mariposa</option> 
                        <option value="09">200m Mariposa</option>
                        <option value="10">50m Espalda</option>
                        <option value="11">100m Espalda</option>
                        <option value="12">200m Espalda</option>
                        <option value="13">50m Braza</option>
                        <option value="14">100m Braza</option>
                        <option value="15">200m Braza</option>
                        <option value="16">100m Estilos</option>
                        <option value="17">200m Estilos</option> 
                        <option value="18">400m Estilos</option>
                        <option value="19">4x50 Libres</option>
                        <option value="20">4x50 Estilos</option>
                    </select>
                </div>

                <div class="row" id="selects">
                    <div class="col-sm-6">
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
                    <div class="col-sm-6">
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

                </div>

                <label for="tiempo"><strong>Tiempo realizado</strong></label>
                <div class="form-inline">
                    <input id=minutos maxLength=2 size=1 value=00 name=minutos class="form-control"> : <input id=segundos maxLength=2 size=1 value=00 name=segundos class="form-control"> . <input id=centesimas maxLength=2 size=1 value=00 name=centesimas class="form-control">
                </div>
                </br>
                <div class="form-group">
                    <input onclick=CalcPtosFINA(this.form) type=button value="Calcular" name=button class="btn btn-success">
                </div>
                <div class="form-group">
                    <label for="tiempo"><strong>Puntos FINA:</strong></label>
                    <input type="text" name="puntos" id="puntos" value="Puntos FINA" readonly class="form-control">
                </div>
            </div>
            </form>
        </div>

    </body>
    <!-- VersiÃ³n compilada y comprimida del JavaScript de Bootstrap -->
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
    <script src="./js/fina.js"></script>
</html>