<!DOCTYPE html>
<html>
    <head>
        <title>MenuPrincipal</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/fonts.css">
        <link rel="stylesheet" href="./css/estilos.css">
        <!-- VersiÃ³n compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">

        <!--<style>
            #logo{
                background-image: url(imagenes/cabecera.JPG);
            }
        </style>-->

    </head>
    <body>
        <?php
        include_once 'conexion.php';
        session_start();

        if (!isset($_SESSION['usuario'])) {
            die("Error - debe <a href='index.php'>identificarse</a>.<br />");
        }
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
                    <a class="navbar-brand" href="menuPrincipal.php">SMW-TIME</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="menuPrincipal.php">Mis tiempos</a></li>
                        <li><a href="ranking.php">Ranking</a></li>
                        <li><a href="conversor.php">Conversor</a></li>
                        <li><a href="convocatorias.php">Convocatorias</a></li>
                        <?php
                        $sql = $conexion->query("select idRol from usuarios where usuario = '" . $_SESSION['usuario'] . "'");
                        $resultado = $sql->fetch();
                        $rol = $resultado[0];
                        if ($rol[0] == 1 || $rol[0] == 2) {
                            echo '<li><a href="editarMarcas.php">Editar marcas</a></li>';
                        }
                        ?>

                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="perfilUsuario.php"><span class="glyphicon glyphicon-user"></span> Hola <?php echo $_SESSION['usuario']; ?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php

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
        ?>
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
                    $resultado = $conexion->query("SELECT * FROM tiempos INNER JOIN pruebas ON tiempos.idPrueba = pruebas.idPrueba WHERE idPiscina = 1 OR idPiscina = 2");
                    while ($registro = $resultado->fetch()) {
                        $fecha = $registro["fecha"];
                        $fechaBuena = formatFecha($fecha, "/");
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
                    $resultado = $conexion->query("SELECT * FROM tiempos INNER JOIN pruebas ON tiempos.idPrueba = pruebas.idPrueba WHERE idPiscina = 3 OR idPiscina = 4");
                    while ($registro = $resultado->fetch()) {
                        $fecha = $registro["fecha"];
                        $fechaBuena = formatFecha($fecha, "/");
                        echo '<tr>';
                        echo '<td>' . $registro["prueba"] . '</td>';
                        echo '<td>' . substr($registro["tiempo"], 3, 10) . '</td>';
                        echo '<td>' . $fechaBuena . '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>

            <!--<form method="post">
                <input type="submit" value="Exportar a PDF" id="generarPDF" name="generarPDF" class="btn btn-success">            
            </form>-->
        </div>


    </body>
    <!-- VersiÃ³n compilada y comprimida del JavaScript de Bootstrap -->
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./bootstrap/js/bootstrap.min.js"></script>
</html>