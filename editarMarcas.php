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

            <script>   
                $(function(){

                 $("#anadirPiscina").click(function(){
                 var url = "Consultas/anadirPiscina.php"; // El script a dónde se realizará la petición.
                    $.ajax({
                           type: "POST",
                           url: url,
                           data: $("#formularioPiscina").serialize(), // Adjuntar los campos del formulario enviado.
                           success: function(data)
                           {
                               $("#piscina").val('');
                               $(".exito").html("<h2 id='texto'>Piscina añadida correctamente!</h2>");
                               $("#texto").fadeOut(2000); 
                               $('#myModalP').modal('toggle');
                           }
                         });

                    return false; // Evitar ejecutar el submit del formulario.
                 });

                 $("#anadirMarca").click(function(){
                 var url = "Consultas/anadirMarca.php"; // El script a dónde se realizará la petición.
                    $.ajax({
                           type: "POST",
                           url: url,
                           data: $("#formularioMarca").serialize(), // Adjuntar los campos del formulario enviado.
                           success: function(data)
                           {
                              
                               $(".exito").html("<h2 id='texto'>Marca añadida correctamente!</h2>");
                               $("#texto").fadeOut(2000); 
                               $('#nuevaMarca').modal('toggle');

                           }
                         });

                    return false; // Evitar ejecutar el submit del formulario.
                 });

                });
            </script>


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
                  <form method="post" id="formularioMarca" >
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

<br /><br /><br />

<script>

//var respuestas=$.ajax('cargarDatatable.php');
$(document).ready(function() {
    var table =$('#usuarios').DataTable( {
        'ajax':{'url':'Consultas/cargarDatatable.php'
                
        },
        "columns": [
            { "data": "idTiempo" },
            { "data": "usuario" },
            { "data": "prueba" },
            { "data": "tiempo" },
            { "data": "fecha" },
            { "data": "tipoPiscina" },
            { "data": "piscina" }

        ],
        "columnDefs": [{
        "targets": 7,
        "data": "boton",
        "render":function (data) { 
                return '<button class="btn-danger" id="borrar" name="borrar">Eliminar</button>';
        }

        },
        {
           "targets": [ 0 ],
           "visible": false,
           "searchable": false
        }
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
    
    $("#usuarios").on("click", "#borrar", function(e){
        tabla = $("#usuarios").DataTable();
        e.preventDefault();
        var nRow = $(this).parents('tr')[0];
                
        aData= tabla.row( nRow ).data();

        var idTiempo1=aData.idTiempo;
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "Consultas/eliminarMarca.php",
            data: { idTiempo: idTiempo1 },        
            success: function(data) {
                //$('#usuarios').fnDraw();
                //$('#usuarios').DataTable().draw();
                
            } 
        });
    });
} );


</script>
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