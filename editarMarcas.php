<!DOCTYPE html>
<html>
    <head>
        <title>EditarMarcas</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/fonts.css">
        <link rel="stylesheet" href="./css/estilos.css">
        <link rel="stylesheet" href="css/datedropper.css">
        <!-- Versión compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/lumen.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
        <!-- Versión compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./bootstrap/js/bootstrap.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="js/datedropper.js"></script>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        
    </head>
    <body>
        <?php
            include_once 'conexion.php';
            include 'DB.php';
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
                    <img alt="SWM-TIME" src="imagenes/logos/crono_48.png">
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
                            echo '<li class="active"><a href="editarMarcas.php">Panel de control</a></li>';
                          }
                        ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="perfilUsuario.php"><span class="glyphicon glyphicon-user"></span> Hola <?php echo $_SESSION['usuario'];?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
             <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">Añadir usuarios</button>
             <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalP">Añadir piscina</button>
             <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalM">Añadir marca</button>
             <button class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModalU">Listado usuarios</button>
            </div>
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
                  <form method="post" action="anadirUsuario.php">
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" id="usuario" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <?php
                        $caracteres = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890"; //posibles caracteres a usar
                        $numerodeletras=10; //numero de letras para generar el texto
                        $pass = ""; //variable para almacenar la cadena generada
                        for($i=0;$i<$numerodeletras;$i++)
                        {
                                $pass .= substr($caracteres,rand(0,strlen($caracteres)),1); /*Extraemos 1 caracter de los caracteres
                                entre el rango 0 a Numero de letras que tiene la cadena */
                        }
                        echo $pass;
                       ?>
                        <input type="hidden" name="pass" id="pass" value="<?php echo md5($pass)?>">
                        <!--<input type="password" id="pass" name="pass" class="form-control">-->
                        </br> 
                       <!--<input type="button" class="btn btn-default" value="Generar contraseña" >-->
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
                    <input type="submit" class="btn btn-success" value="Añadir">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </form>
              </div>
            </div>
          </div>
        </div>


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
                  <form method="post" action="anadirPiscina.php">
                    <div class="form-group">
                        <label>Piscina</label>
                        <input type="text" id="piscina" name="piscina" class="form-control">
                    </div>
                  </br>
                  <input type="submit" class="btn btn-success" value="Añadir" id="anadirPiscina">

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </form>
              </div>
            </div>
          </div>
        </div>





<!-- Modal -->
        <div id="myModalM" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Añadir usuarios</h4>
              </div>
              <div class="modal-body">
                  <form method="post" action="anadirMarca.php">
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
                        <input type="text" name="marca" id="marca" class="form-control" placeholder="XX:XX:XX.XX">
                    </div>
                    <div class="form-group">
                        <label>Fecha</label>
                        <input type="text" id="fechaMarca" name="fechaMarca" class="form-control"/>
                        <script>$( "#fechaMarca" ).dateDropper();</script>
                    
                    </div>
                    <input type="submit" class="btn btn-success" value="Añadir">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
              </form>
              </div>
            </div>
          </div>
        </div>

 <!-- Modal -->
        <div id="myModalU" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Usuarios</h4>
              </div>
              <div class="modal-body">
              <?php
                 $sqlUSU = $conexion->query("select * from usuarios");
                 while ($registroUSU = $sqlUSU->fetch()) {
                     echo $registroUSU['usuario']."<br />";
                 }
              ?>
             <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

            </div>
          </div>
        </div>

        </div>
<br /><br /><br />

<script>

//var respuestas=$.ajax('cargarDatatable.php');
$(document).ready(function() {
    var table =$('#editarMarcas').DataTable( {
        'ajax':{'url':'cargarDatatable.php'
                
        },
        "columns": [
            { "data": "usuario" },
            { "data": "prueba" },
            { "data": "marca" },
            { "data": "fecha" },
            { "data": "tipo_piscina" },
            { "data": "piscina" },
            { "defaultContent": "<button class='btn btn-info'>Editar</button>"}
        ],
        
        "language": {
            "sProcessing":     "Procesando...",
            "sLengthMenu":     "Mostrar _MENU_ registros",
            "sZeroRecords":    "No se encontraron resultados",
            "sEmptyTable":     "Ningún dato disponible en esta tabla",
            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":    "",
            "sSearch":         "Buscar:",
            "sUrl":            "",
            "sInfoThousands":  ",",
            "sLoadingRecords": "Cargando...",
            "oPaginate": {
                "sFirst":    "Primero",
                "sLast":     "Último",
                "sNext":     "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }
    } );
    $('#editarMarcas tbody').on( 'click', 'button', function () {
         var data = table.row( $(this).parents('tr') ).data();
            alert( data[0] );
        //https://datatables.net/examples/ajax/null_data_source.html
        //alert( "click!" );
        } );
} );


</script>
<table id="editarMarcas" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Prueba</th>
                <th>Marca</th>
                <th>Fecha</th>
                <th>Tipo Piscina</th>
                <th>Piscina</th>
                <th>Editar</th>
            </tr>
        </thead>

    </table>



      </div>
    </body>

</html>					