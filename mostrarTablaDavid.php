function mostrarTabla(){
      $('#listaNoticias').show('slow'); 
        
    $('#listaNoticias').DataTable({
 
                  'ajax':{'url':'listarNoticias',
                   "dataSrc": ""
                  },
                 
         "columns": [
            { "data": "id" },
            { "data": "title" },
            { "data": "description" },
            { "data": "contenido" },
            { "data": "urlImg" },
            { "data": "estado",'render':function (data){
                    if(data===1){
                        return ('Publicado');
                    }else{
                            
                            return ('No publicado');
                        }
                        
                    
                    
            } },
            {'data': "id",
                  'render': function() {
                      /*añadimos las clases editarbtn y borrarbtn para procesar los eventos click de los botones. No lo hacemos mediante id ya que habrá más de un botón de edición o borrado*/
                    return "<button class='btn btn-sm btn-primary'> Editar</button><span> </span><button class='borrarbtn btn btn-xs btn-danger'>Borrar</button>";

                  }
              }

        ],
        'language':{
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









      });

          
    }