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