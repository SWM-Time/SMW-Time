<!DOCTYPE html>
<html>
    <head>
        <title>SWM-TIME</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="./imagenes/logos/favicon.png">
        <link rel="stylesheet" href="./css/fonts.css">
        <link rel="stylesheet" href="./css/estilos.css">
        <!-- Versión compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">  
        <link rel="stylesheet" href="css/lumen.css">
        <link rel="stylesheet" href="css/index.css">

    </head>
    <body>
        <?php
        include_once 'Consultas/conexion.php';
        ini_set('display_errors', '0');     
        error_reporting(E_ALL | E_STRICT);
            $usuario = htmlspecialchars($_POST['usuario']);
            $pass = htmlspecialchars($_POST['pass']);
            
            if (isset($_POST['validar'])) {
                if (empty($usuario) || empty($pass)) {
                    $error= 'No dejes campos en blanco';
                } else {
                    $login = $conexion->prepare("select * from usuarios where usuario=? AND pass=?");
                    $login->bindParam(1, $usuario);
                    $login->bindParam(2,md5($pass));
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
        <div class="jumbotron">
  <div class="container text-center">
        <img src="imagenes/cronos/crono128.png">      
        <h4>SWM-Time</h4>
  </div>
</div>
        <div class="container">  
            <div class="row">
    <!-----------------------------------CARROUSEL-------------------->
    <div class="col-sm-6">
        <div id="fotosOlivar" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                    <img src="imagenes/carrousel/olivar1.jpg" alt="abso">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Equipo Absoluto</h3>
                    </div>
              </div>
              <div class="item">
                    <img src="imagenes/carrousel/olivar2.jpg" alt="juni">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Equipo Junior</h3>
                    </div>
              </div>
              <div class="item">
                    <img src="imagenes/carrousel/olivar3.jpg" alt="team">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Todas las categorías</h3>
                    </div>
              </div>
              <div class="item">
                    <img src="imagenes/carrousel/olivar4.jpg" alt="oli">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Campeones de Aragón</h3>
                    </div>
              </div>
              <div class="item">
                    <img src="imagenes/carrousel/olivar5.jpg" alt="oli_masc">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Campeones de Aragón categoría masculina</h3>
                    </div>
              </div>
              <div class="item">
                    <img src="imagenes/carrousel/olivar6.jpg" alt="oli_fem">
                    <div class="carousel-caption d-none d-md-block">
                        <h3>Campeones de Aragón categoría femenina</h3>
                    </div>
              </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#fotosOlivar" role="button" data-slide="prev">
              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#fotosOlivar" role="button" data-slide="next">
              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
            
        </div>
    
            
            
    <!-----------------------------------LOGIN-------------------->
<div class="col-sm-6">    
    <div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3"> 
        
        
        <div class="panel panel-default" >
            <div class="panel-heading">
                <div class="text-center">
                    <h4>Acceder</h4> 
                </div>
                
            </div>     

            <div class="panel-body" >

                <form name="form" id="form" class="form-horizontal" enctype="multipart/form-data" method="POST">
                   
                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                        <input id="user" type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">                                        
                    </div>

                    <div class="input-group">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                        <input id="password" type="password" class="form-control" name="pass" id="pass" placeholder="Contraseña">
                    </div>                                                                  
                    
                    <div class="form-group">
                            <label for="error" class="error"><?php echo $error; ?></label>
                    </div>
                    
                    <div class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button type="submit" id="validar" name="validar" class="btn btn-success pull-right"><i class="glyphicon glyphicon-log-in"></i>   Entrar</button>                          
                        </div>
                    </div>

                </form>     

            </div>                     
        </div>  
    </div>
</div>
   </div>
        </div>    
    </body>
    <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
</html>
