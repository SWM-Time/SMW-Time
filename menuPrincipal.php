<!DOCTYPE html>
<html>
    <head>
        <title>MenuPrincipal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="./imagenes/logos/favicon.png">
        <link rel="stylesheet" href="./css/fonts.css">
        <link rel="stylesheet" href="./css/estilos.css">
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
                        $sql = $conexion->query("select idRol from usuarios where usuario = '".$_SESSION['usuario']."'");
                        $resultado = $sql->fetch();
                        $rol = $resultado[0];
                        if($rol[0] == 1 || $rol[0] == 2){
                                echo '<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="editarMarcas.php">Panel de control<span class="caret"></span></a>';
                                    echo '<ul class="dropdown-menu">';
                                        echo '<li><a href="editarMarcas.php">Marcas</a></li>';
                                        echo '<li><a href="usuarios.php">Usuarios</a></li>';
                                    echo '</ul>';
                                echo '</li>';
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
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>PRUEBA</th>
                        <th>TIEMPO EN PISCINA DE 25</th>
                        <th>FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //$resultado = $conexion->query("SELECT prueba, fecha, min(tiempo) AS min_tiempo FROM tiempos INNER JOIN pruebas ON tiempos.idPrueba = pruebas.idPrueba WHERE idUsuario = ".$foo." AND (idTipoPiscina = 1 OR idTipoPiscina = 2)  GROUP BY prueba ORDER BY pruebas.idPrueba ASC");
                    //$resultado = $conexion->query("SELECT t.* FROM tiempos t INNER JOIN (SELECT idPrueba, idTiempo, MIN(tiempo) AS min_tiempo FROM tiempos GROUP BY idTiempo) t1 ON t1.idTiempo = t.idTiempo INNER JOIN pruebas ON t.idPrueba = pruebas.idPrueba WHERE t1.idTiempo = t.idTiempo AND t1.min_tiempo = t.tiempo AND t1.idPrueba = t. idPrueba AND idUsuario = ".$foo." AND (idTipoPiscina = 1 OR idTipoPiscina = 2) GROUP BY idPrueba ORDER BY pruebas.idPrueba ASC");
                    $resultado = $conexion->query("SELECT tiempo, prueba, fecha FROM tiempos t INNER JOIN (SELECT idPrueba, idTiempo, MIN(tiempo) AS min_tiempo FROM tiempos GROUP BY idTiempo) t1 ON t1.idTiempo = t.idTiempo INNER JOIN pruebas p ON t.idPrueba = p.idPrueba WHERE t1.idTiempo = t.idTiempo AND t1.min_tiempo = t.tiempo AND t1.idPrueba = t.idPrueba AND idUsuario = ".$foo." AND (idTipoPiscina = 1 OR idTipoPiscina = 2) GROUP BY p.idPrueba ORDER BY p.idPrueba ASC");
                    while ($registro = $resultado->fetch()) {
                        $fecha = $registro["fecha"];
                        $fechaBuena = utiles::formatFecha($fecha, "/");
                        echo '<tr>';
                        echo '<td>' . $registro["prueba"] . '</td>';
                        echo '<td>' . substr($registro["tiempo"], 3, 10) . '</td>';
                        echo '<td>' . $fechaBuena . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>

            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>PRUEBA</th>
                        <th>TIEMPO EN PISCINA DE 50</th>
                        <th>FECHA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $resultado = $conexion->query("SELECT prueba, fecha, min(tiempo) AS min_tiempo FROM tiempos INNER JOIN pruebas ON tiempos.idPrueba = pruebas.idPrueba WHERE idUsuario = ".$foo." AND (idTipoPiscina = 3 OR idTipoPiscina = 4)  GROUP BY prueba ORDER BY pruebas.idPrueba ASC");
                    while ($registro = $resultado->fetch()) {
                        $fecha = $registro["fecha"];
                        $fechaBuena = utiles::formatFecha($fecha, "/");
                        echo '<tr>';
                        echo '<td>' . $registro["prueba"] . '</td>';
                        echo '<td>' . substr($registro["min_tiempo"], 3, 10) . '</td>';
                        echo '<td>' . $fechaBuena . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </body>
    <!-- VersiÃ³n compilada y comprimida del JavaScript de Bootstrap -->
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</html>