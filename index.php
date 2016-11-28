<!DOCTYPE html>
<html>
    <head>
        <title>SWM-TIME</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/fonts.css">
        <link rel="stylesheet" href="./css/estilos.css">
        <!-- Versión compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">        
        
    </head>
    <body>
        <?php
        include_once 'conexion.php';
        error_reporting(E_ALL^E_NOTICE);
            $usuario = $_POST['usuario'];
            $pass = $_POST['pass'];
            
            if (isset($_POST['validar'])) {
                if (empty($usuario) || empty($pass)) {
                    $error= 'No dejes campos en blanco';
                } else {
                    $login = $conexion->prepare("select * from usuarios where usuario=? AND pass=?");
                    $login->bindParam(1, $usuario);
                    //$login->bindParam(2, MD5($pass)); b48315d52b88d4013a2b5bf1be8f40d1
                    $login->bindParam(2,Md5($pass));
                    $login->execute();
                    if ($login = $login->fetch()) {
                        session_start();
                        $_SESSION['usuario'] = $usuario;
                        header('Location: menuPrincipal.php');
                    } else {
                        $error= 'Datos incorrectos';
                    }
                }
            }
            ?>
        <div class="jumbotron text-center">
            <img src="imagenes/logos/crono_128.png"> 
        </div>
        <div class="container">
                <div class="col-offset-6 centered">
                    <h3 class="text-center">Acceder</h3>
                    <form role="form" method="post" action="">
                        <div class="form-group">
                            <label for="email">Usuario:</label>
                            <input type="text" class="form-control" id="usuario" name="usuario">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Contraseña:</label>
                            <input type="password" class="form-control" id="pass" name="pass">
                        </div> 
                        <div class="form-group">
                            <label for="error" class="error"><?php echo $error; ?></label>
                        </div>
                        
                        <button type="submit" class="btn btn-default" id="validar" name="validar">Entrar</button>
                    </form>
                </div>
        </div>    
    </body>
    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
</html>
