<!DOCTYPE html>
<html>
    <head>
        <title>Ranking</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="./css/fonts.css">
        <!-- VersiÃ³n compilada y comprimida del CSS de Bootstrap -->
        <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/lumen.css">
        <link rel="stylesheet" href="./bootstrap/css/bootstrap-theme.min.css">
         <!-- VersiÃ³n compilada y comprimida del JavaScript de Bootstrap -->
        <script src="./js/jquery-3.1.1.min.js"></script>
        <script src="./bootstrap/js/bootstrap.min.js"></script>

       
        
    </head>
    <body>
        <?php
            include_once 'Consultas/conexion.php';    
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
                        <li class="active"><a href="ranking.php">Ranking</a></li>
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
                        <li><a href="perfilUsuario.php"><span class="glyphicon glyphicon-user"></span> Hola <?php echo $_SESSION['usuario'];?></a></li>
                        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            


            <script>   
                $(function(){
                 $("#ver").click(function(){
                 var url = "Consultas/ranking.php"; // El script a dónde se realizará la petición.
                    $.ajax({
                           type: "POST",
                           url: url,
                           data: $("#formulario").serialize(), // Adjuntar los campos del formulario enviado.
                           success: function(data)
                           {
                               $("#marcas").html(data); // Mostrar la respuestas del script PHP.
                           }
                         });

                    return false; // Evitar ejecutar el submit del formulario.
                 });
                });
                </script>





            <!--<form class="form-inline" name="formulario" onsubmit="MostrarConsulta('consulta.php'); return false">-->
            <form class="form-inline" method="post" id="formulario">
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
                        <label>Prueba:</label>
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
                        <label>Piscina:</label>
                        <select id='piscina' name='piscina' class="form-control">
                            <option value="1">25</option>
                            <option value="2">50</option>
                        </select>
              </div>
              <div class="form-group">
                  <input type="button" value="Ver" id="ver" name="ver" class="btn btn-success">
              </div>
           </form>
        <div id="marcas">
         
        </div>

        </div>      
    </body>

</html>	