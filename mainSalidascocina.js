$(document).ready(function() {
    var id_salida, opcion;
    opcion = 2;
        
    tablaSalidas = $('#tablaSalidas').DataTable({  
        "ajax":{            
            "url": "bd/crudsalidascocina.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "id_salida"},
            {"data": "id_prod"},
            {"data": "cantidad"},
            {"data": "salida"},
            {"data": "user"},
        ]
    });     
    
    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#formSalidas').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        id_prod = $.trim($('#id_prod').val());    
        cantidad = $.trim($('#cantidad').val());
        salida = $.trim($('#salida').val());    
        user = $.trim($('#user').val());                                
            $.ajax({
              url: "bd/crudsalidascocina.php",
              type: "POST",
              datatype:"json",    
              data:  {id_salida:id_salida, id_prod:id_prod, cantidad:cantidad, salida:salida, user:user,opcion:opcion},    
              success: function(data) {
                tablaSalidas.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta una Persona
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        id_salida=null;
        $("#formSalidas").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Registrar Salida");
        $('#modalCRUD').modal('show');	    
    });
         
    });    