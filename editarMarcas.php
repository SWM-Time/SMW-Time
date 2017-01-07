<!DOCTYPE html>
<html>
    <head>
        <title>EditarMarcas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="./imagenes/logos/favicon.png">
        <link rel="stylesheet" href="./css/fonts.css">
        <link rel="stylesheet" href="./css/estilos.css">
        <link rel="stylesheet" href="css/datedropper.css">
        <!-- Versión compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/lumen.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css" />
        <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./bootstrap/js/bootstrap.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/datedropper.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/plug-ins/1.10.13/api/fnReloadAjax.js"></script>
        <!--Cargamos los scripts necesarios para poder hacer las validaciones:-->
        <!--Los scripts se cargan siempre después de los css, nunca antes!-->
        <script type="text/javascript" src="libs/jquery.validate.js"></script>
        <!------------------------------------------------------->
        <script type="text/javascript" src="libs/jquery-validation-1.14.0/dist/additional-methods.js"></script>
        <!--Mensajes en español-->
        <script type="text/javascript" src="libs/jquery-validation-1.14.0/dist/localization/messages_es.js"></script>
        <!------------------------------------------------------->
        <!--Cambiar el color a los mensajes de error-->
        <style>
            .error{
                color: red;
                font-size: 12px;
            }
        </style>
        <script type="text/javascript" src="js/cargarDatatable.js"></script>
        <script type="text/javascript" src="js/editarMarcas.js"></script>
        
    </head>
    <body>
        <?php
            include_once 'Consultas/conexion.php';
            include 'utiles.php';
            session_start();
            
            if (!isset($_SESSION['usuario'])) {
                die("Error - debe <a href='index.php'>identificarse</a>.<br />");
            }
            $sql = $conexion->query("select idRol from usuarios where usuario = '".$_SESSION['usuario']."'");
            $resultado = $sql->fetch();
            $rol = $resultado[0];
            if($rol[0] != 1 ){
                die("Error - no tienes permisos para entrar aqui. <a href='menuPrincipal.php'>Volver</a>");
            }
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
                        <li><a href="perfilUsuario.php"><span class="glyphicon glyphicon-user"></span> Hola <?php echo $_SESSION['usuario'];?></a></li>
                        <li><a href="Consultas/logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalP">Añadir piscina</button>
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#nuevaMarca">Añadir marca</button>
            </div>
            <div class="exito"></div>



            <!-- Modal -->
        <div id="myModalP" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Añadir piscinas</h4>
              </div>
              <div class="modal-body">
                  <form method="post" id="formularioPiscina">
                    <div class="form-group">
                        <label>Piscina</label>
                        <input type="text" id="piscina" name="piscina" class="form-control">
                    </div>
                    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#piscinas">Ver piscinas</button>
                        <div id="piscinas" class="collapse">
                            </br>
                            <?php
                                $sqlPiscinas = $conexion->query("select * from piscinas ");
                                while ($registroPiscinas = $sqlPiscinas->fetch()) {
                                    echo "<li>".$registroPiscinas['piscina']."</li>";
                                }
                            ?>
                        </div>
                  </br></br>
                  <input type="submit" class="btn btn-success" value="Añadir" id="anadirPiscina">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </form>
              </div>
            </div>
          </div>
        </div>

<!-- Modal -->
        <div id="nuevaMarca" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Añadir marcas</h4>
              </div>
              <div class="modal-body">
                  <form method="post" id="formularioMarca" novalidate="">
                    <div class="form-group">
                        <label>Nadador</label>
                        <select id='nadador' name='nadador' class="form-control">
                        <?php
                        $sqlN = $conexion->query("select * from usuarios ");
                        while ($registroN = $sqlN->fetch()) {
                            echo "<option value='".$registroN['idUsuario']."'>".$registroN['usuario']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Prueba</label>
                        <select id='prueba' name='prueba' class="form-control">
                        <?php
                        $sqlP = $conexion->query("select * from pruebas");
                        while ($registroP = $sqlP->fetch()) {
                            echo "<option value='".$registroP['idPrueba']."'>".$registroP['prueba']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="text" id="fechaMarca" name="fechaMarca" class="form-control"/>
                        <script>$( "#fechaMarca" ).dateDropper();</script>
                    
                    </div>
                    <div class="form-group">
                        <label>Tipo piscina</label>
                        <select id='tipoPiscina' name='tipoPiscina' class="form-control">
                        <?php
                        $sqlTP = $conexion->query("select * from tipopiscina");
                        while ($registroTP = $sqlTP->fetch()) {
                            echo "<option value='".$registroTP['idTipoPiscina']."'>".$registroTP['tipoPiscina']."</option>";
                        }
                        ?>
                        </select>
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
                        <label>Piscina</label>
                        <select id='piscina' name='piscina' class="form-control">
                        <?php
                        $sqlPS = $conexion->query("select * from piscinas");
                        while ($registroPS = $sqlPS->fetch()) {
                            echo "<option value='".$registroPS['idPiscina']."'>".$registroPS['piscina']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                      <div class="form-group">
                        <label>Temporada</label>
                        <select id='temporada' name='temporada' class="form-control">
                        <?php
                        $sqlTP = $conexion->query("select * from temporadas");
                        while ($registroTP = $sqlTP->fetch()) {
                            echo "<option value='".$registroTP['idTemporada']."'>".$registroTP['inicioTemporada']."/".$registroTP['finTemporada']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <input type="text" name="marca" id="marca" class="form-control" placeholder="XX:XX.XX">
                    </div>
                      <input type="submit" class="btn btn-success" value="Añadir" id="anadirMarca" name="anadirMarca">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        <script>
        $("#formularioMarca").validate({
            onkeyup:false,
            onfocusout:false,
            onclick:false,
            rules:{
                marca:{
                    required:true,
                    pattern: /^\d{2}:\d{2}.\d{2}$/
                }
            },
            messages:{
                marca:"Escribe un formato valido 00:00.00"
            }
        });
        </script>

<br /><br /><br />

<table id="usuarios" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>idTiempo</th>
                <th>Usuario</th>
                <th>Prueba</th>
                <th>Marca</th>
                <th>Fecha</th>
                <th>Tipo piscina</th>
                <th>Piscina</th>
                <th>Eliminar</th>
            </tr>
        </thead>

    </table>
      </div>
    </body>

</html>					