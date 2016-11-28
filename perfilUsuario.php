<!DOCTYPE html>
<html>
    <head>
        <title>MiPerfil</title>
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
                        <li><a href="menuPrincipal.php">Mis tiempos</a></li>
                        <li><a href="ranking.php">Ranking</a></li>
                        <li><a href="conversor.php">Conversor</a></li>
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
                        <li  class="active"><a href="perfilUsuario.php"><span class="glyphicon glyphicon-user"></span> Hola <?php echo $_SESSION['usuario'];?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
        <form method="post" action="updateUsuario.php">
        <?php
            $sqlDatos = $conexion->query("select * from usuarios where usuario='".$_SESSION['usuario']."'");
            while ($fila=$sqlDatos->fetch()){
                echo "<label>Usuario:</label><input type='text' class='form-control' name='usuario' id='usuario' value='$fila[1]'>";
                echo "<label>Nombre:</label><input type='text' class='form-control' name='nombre' id='nombre' value='$fila[3]'>";
                echo "<input type='hidden'  name='pass' id='pass' value='$fila[2]'>";
                echo "<label>Primer apellido:</label><input type='text' class='form-control' name='apellido1' id='apellido1' value='$fila[4]'>";
                echo "<label>Segundo Apellido:</label><input type='text' class='form-control' name='apellido2' id='apellido2' value='$fila[5]'>";
                echo "<label>Fecha de nacimiento:</label><input type='text' class='form-control' name='fnac' id='fnac' value='$fila[7]'>";
                echo "<label>Email:</label><input type='text' class='form-control' name='email' id='email' value='$fila[10]'>";
                echo "<label>Contraseña:</label></br>";    
            }
        ?>
            <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#cambiaPass">Cambiar contraseña</button>
            <div id="cambiaPass" class="collapse">
                    </br>
                    <label>Nueva contraseña</label>
                    <input type="text" name="pass1" id="pass1" class='form-control'>
                    <label>Repite contraseña</label>
                    <input type="text" name="pass2" id="pass2" class='form-control'>      
          </div>
            </br></br></br>
            <input type="submit" value="Guardar" id="nuevaPass" name="nuevaPass" class="btn btn-success">
        </form>
        </div>      
    </body>
<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
</html>
