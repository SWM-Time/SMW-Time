
//var respuestas=$.ajax('cargarDatatable.php');
$(document).ready(function() {
    var table =$('#usuarios').DataTable( {
        'ajax':{'url':'Consultas/cargarDatatableUsuarios.php'
                
        },
        "columns": [
            { "data": "idUsuario" },
            { "data": "usuario" },
            { "data": "nombre" },
            { "data": "apellido1" },
            { "data": "apellido2" },
            { "data": "fnac" },
            { "data": "email" }

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

        var idUsuario1=aData.idUsuario;
        
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "Consultas/eliminarUsuario.php",
            data: { idUsuario: idUsuario1 },        
            success: function(data) {
                //$('#usuarios').raw();
                //$('#usuarios').DataTable().ajax.reload();
                
            } 
        });
    });
} );
