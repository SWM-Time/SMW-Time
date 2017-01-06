<!DOCTYPE html>
<html>
    <head>
        <title>MiPerfil</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="./imagenes/logos/favicon.png">
        <link rel="stylesheet" href="./css/fonts.css">
        <!-- Versión compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/lumen.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
        <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>
        <!--Cargamos los scripts necesarios para poder hacer las validaciones:-->
        <!--Los scripts se cargan siempre después de los css, nunca antes!-->
        <script type="text/javascript" src="libs/jquery-1.8.2.min.js"></script>
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
        
    </head>
    <body>
        <?php
            include_once 'Consultas/conexion.php';
            include './utiles.php';
            session_start();
            
            if (!isset($_SESSION['usuario'])) {
            die("Error - debe <a href='index.php'>identificarse</a>.<br />");
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
                            echo '<li><a href="editarMarcas.php">Panel de control</a></li>';
                          }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li  class="active"><a href="perfilUsuario.php"><span class="glyphicon glyphicon-user"></span> Hola <?php echo $_SESSION['usuario'];?></a></li>
                        <li><a href="Consultas/logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
        <div class="exito"></div>
        <form method="post" action="Consultas/updateUsuario.php" novalidate id="modificaPerfil">
        <?php
            $sqlDatos = $conexion->query("select * from usuarios where usuario='".$_SESSION['usuario']."'");
            while ($fila=$sqlDatos->fetch()){
                $fecha = utiles::formatFecha($fila[7]);
                echo "<label>Usuario:</label><input type='text' class='form-control' name='usuario' id='usuario' value='$fila[1]' disabled>";
                echo "<label>Nombre:</label><input type='text' class='form-control' name='nombre' id='nombre' value='$fila[3]'>";
                echo "<label>Primer apellido:</label><input type='text' class='form-control' name='apellido1' id='apellido1' value='$fila[4]'>";
                echo "<label>Segundo Apellido:</label><input type='text' class='form-control' name='apellido2' id='apellido2' value='$fila[5]'>";
                echo "<label>Fecha de nacimiento:</label><input type='text' class='form-control' name='fnac' id='fnac' value='$fecha'>";
                echo "<label>Email:</label><input type='text' class='form-control' name='email' id='email' value='$fila[10]'>"; 
            }
        ?>
            <br/>
            <input type="submit" value="Guardar" id="nuevaPass" name="nuevaPass" class="btn btn-success">
        </form>
        <script>
        $("#modificaPerfil").validate({
            onkeyup:false,
            onfocusout:false,
            onclick:false,
            rules:{
                nombre:{
                    required:true,
                    pattern: /[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+/,
                    minlength:2
                },
                apellido1:{
                    required:true,
                    pattern: /[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+/,
                    minlength:2
                    
                },
                apellido2:{
                    required:true,
                    pattern: /[a-zA-ZñÑáéíóúÁÉÍÓÚ\s]+/,
                    minlength:2
                },
                fnac:{
                    required:true,
                    pattern: /^[0-3]?[0-9].[0-3]?[0-9].(?:[0-9]{2})?[0-9]{2}$/
                },
                email:{
                    email:true
                }
            },
            messages:{
                nombre:"Nombre incorrecto",
                fnac:"Escribe un formato valido dd/mm/aaaa"
            }
        });
        </script>
        <br/>
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#cambiaPass">Cambiar contraseña</button>
            <script>
                 $(function(){
                 $("#guardarPass").click(function(){
                 var url = "Consultas/cambiaPass.php"; // El script a dónde se realizará la petición.
                    $.ajax({
                           type: "POST",
                           url: url,
                           data: $("#formularioPass").serialize(), // Adjuntar los campos del formulario enviado.
                           success: function(data)
                           {
                               $("#pass1").val('');
                               $("#pass2").val('');
                               $(".exito").html("<h2 id='texto'>Contraseña cambiada correctamente!</h2>");
                               $("#texto").fadeOut(2000); 
                               $('#cambiaPass').modal('toggle');

                           }
                         });

                    return false;
                 });
                 });
                 </script>
            <div id="cambiaPass" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Nueva contraseña</h4>
              </div>
              <div class="modal-body">
                  <form method="post" id="formularioPass">
                    <div class="form-group">
                        <label>Nueva contraseña</label>
                        <input type="password" id="pass1" name="pass1" class="form-control">
                    </div>
                  </br>
                 
                   <input type="submit" class="btn btn-success" value="Guardar contraseña" id="guardarPass" >
                  

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </form>
              </div>
            </div>
          </div>
        </div>
        
        </div>      
    </body>

</html>
