<!DOCTYPE html>
<html>
    <head>
        <title>Convocatorias</title>
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
                        <li class="active"><a href="convocatorias.php">Convocatorias</a></li>
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
                        <li><a href="logout.php" id="cerrarSesion"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <?php
        
            $rol = $resultado[0];
            if($rol[0] == 1 || $rol[0] == 2){
                echo "<div class='container'>";
                
                echo '<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Añadir convocatoria</button>';
                
                echo "</div>";
                echo "</br>";
            }
        
        ?>
        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Añadir convocatoria</h4>
              </div>
              <div class="modal-body">
                  <form method="post" enctype="multipart/form-data" action="guardarConvocatoria.php">
                    <div class="form-group">
                        <label>Convocatoria:</label><input name="convocatoria" type="file">
                    </div>
                    <div class="form-group">
                        <label>Tipo competición:</label>
                        <select id='tipoCompeticion' name='tipoCompeticion' class="form-control">
                        <?php
                        $sqlTC = $conexion->query("select * from tipocompeticion ");
                        while ($registro = $sqlTC->fetch()) {
                            echo "<option value='".$registro['idTipoCompeticion']."'>".$registro['tipoCompeticion']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Piscina:</label>
                        <select id='piscina' name='piscina' class="form-control">
                        <?php
                        $sqlP = $conexion->query("select * from piscinas ");
                        while ($registroP = $sqlP->fetch()) {
                            echo "<option value='".$registroP['idPiscina']."'>".$registroP['piscina']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Categoría:</label>
                        <select id='categoria' name='categoria' class="form-control">
                        <?php
                        $sqlC = $conexion->query("select * from categorias ");
                        while ($registroC = $sqlC->fetch()) {
                            echo "<option value='".$registroC['idCategoria']."'>".$registroC['categoria']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha:</label>
                        <input type="text" id="fecha" name="fecha" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Hora:</label>
                        <input type="text" id="hora" name="hora" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Tipo piscina:</label>
                        <select id='tipoPiscina' name='tipoPiscina' class="form-control">
                        <?php
                        $sqlTP = $conexion->query("select * from tipopiscina ");
                        while ($registroTP = $sqlTP->fetch()) {
                            echo "<option value='".$registroTP['idTipoPiscina']."'>".$registroTP['tipoPiscina']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                      <div class="form-group">
                        <label>Temporada:</label>
                        <select id='temporada' name='temporada' class="form-control">
                        <?php
                        $sqlTE = $conexion->query("select * from temporadas ");
                        while ($registroTE = $sqlTE->fetch()) {
                            
                            echo "<option value='".$registroTE['idTemporada']."'>".$registroTE['inicioTemporada']."/".$registroTE['finTemporada']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                      
                  
                <?php
                /*$directorio = "Convocatorias/"; 
                $directorio = $directorio . basename( $_FILES['convocatoria']['name']); 
                if(move_uploaded_file($_FILES['convocatoria']['tmp_name'], $directorio)) 
                { 
                echo "El archivo ". basename( $_FILES['convocatoria']['name'])." ha sido subido exitosamente!"; 
                } 
                else
                { 
                echo "Hubo un error al subir tu archivo! Por favor intenta de nuevo."; 
                }*/
                ?>
                      </br>
                      <input type="submit" class="btn btn-success" value="Añadir">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </form>
                
              </div>
            </div>   
          </div>
        </div>
        <div class="container">
            <?php
            $resultadoC = $conexion->query("select * from convocatorias "
                    . "INNER JOIN piscinas ON convocatorias.idPiscina=piscinas.idPiscina "
                    . "INNER JOIN tipopiscina ON convocatorias.idTipoPiscina=tipopiscina.idTipoPiscina "
                    . "INNER JOIN tipocompeticion ON convocatorias.idTipoCompeticion=tipocompeticion.idTipoCompeticion "
                    . "INNER JOIN categorias ON convocatorias.idCategoria=categorias.idCategoria order by idCompeticion desc;");                   
            while ($registro = $resultadoC->fetch()) {
                echo '<div class="col-md-4 col-sm-6">';
                echo '<div class="panel panel-info">';
                echo '<h3>'.$registro['tipoCompeticion'].'&nbsp;'.$registro['piscina'].'</h3></br>';
                echo '<label>Categoria: '.$registro['categoria'].'</label></br>';                
                echo '<label>Fecha: '.$registro['fecha'].'</label></br>';
                echo '<label>Hora: '.$registro['hora'].'</label></br>';
                echo '<label>Piscina: '.$registro['tipoPiscina'].'</label></br>';
                echo '<a href="'.$registro['url'].'" target="_blank" class="btn btn-info btn-lg"><span class="glyphicon glyphicon-file"></span> Ver convocatoria</a></br>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>      
    </body>
<!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
</html>