<!DOCTYPE html>
<html>
    <head>
        <title>Editar Marcas</title>
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
        <script src="js/cargarDatatableUsuarios.js"></script>
        
        
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
                <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Añadir usuarios</button>
            </div>
            <div class="exito"></div>

            <script>   
                $(function(){
                 /*$("#anadirUsuario").click(function(){
                 var url = "Consultas/anadirUsuario.php"; // El script a dónde se realizará la petición.
                    $.ajax({
                           type: "POST",
                           url: url,
                           data: $("#formularioUsuario").serialize(), // Adjuntar los campos del formulario enviado.
                           success: function(data)
                           {
                               $("#new_usuario").val('');
                               $("#pass").val('');
                               $("#nombre").val('');
                               $("#apellido1").val('');
                               $("#apellido2").val('');
                               $("#fnac").val('');
                               $("#email").val('');
                               $(".exito").html("<h2 id='texto'>Usuario añadido correctamente!</h2>");
                               $("#texto").fadeOut(2000); 
                               $('#myModal').modal('toggle');

                           }
                         });

                    return false; // Evitar ejecutar el submit del formulario.
                 });*/
                });
            </script>


            <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Añadir usuarios</h4>
              </div>
              <div class="modal-body">
                  <form method="post" id="formularioUsuario" action="Consultas/anadirUsuario.php">
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" id="new_usuario" name="new_usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contraseña -> </label>
                        <?php
                            $pass = utiles::generaPass();
                            echo $pass;
                            echo "<input type='hidden' id='pass' name='pass' value=".$pass.">";
                       ?>
                        
                        </br> 
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" id="nombre" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Primer apellido</label>
                        <input type="text" id="apellido1" name="apellido1" class="form-control">
                    </div>
                      <div class="form-group">
                        <label>Segundo apellido</label>
                        <input type="text" id="apellido2" name="apellido2" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Rol</label>
                        <select id='rol' name='rol' class="form-control">
                        <?php
                        $sqlR = $conexion->query("select * from roles ");
                        while ($registroR = $sqlR->fetch()) {
                            echo "<option value='".$registroR['idRol']."'>".$registroR['rol']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de nacimiento</label>
                        <input type="text" id="fnac" name="fnac" class="form-control"/>
                        <script>$( "#fnac" ).dateDropper();</script>
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
                        <label>Sexo:</label>
                        <select id='sexo' name='sexo' class="form-control">
                        <?php
                        $sqlS = $conexion->query("select * from sexo ");
                        while ($registroS = $sqlS->fetch()) {
                            echo "<option value='".$registroS['idSexo']."'>".$registroS['sexo']."</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" id="email" name="email" class="form-control">
                    </div>
                  </br>
                  <input type="submit" class="btn btn-success" value="Añadir" id="anadirUsuario" name="anadirUsuario">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </form>
              </div>
            </div>
          </div>
        </div>

<br /><br /><br />

<table id="usuarios" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>idUsuario</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellido1</th>
                <th>Apellido2</th>
                <th>Fecha nacimiento</th>
                <th>Email</th>
                <th>Eliminar</th>
            </tr>
        </thead>

    </table>



      </div>
    </body>

</html>					