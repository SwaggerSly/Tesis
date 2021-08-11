$(document).ready(function() {
    var id_salida, opcion;
    opcion = 4;
        
    tablaSalidas = $('#tablaSalidas').DataTable({  
        "ajax":{            
            "url": "bd/crudsalidas.php", 
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
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
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
              url: "bd/crudsalidas.php",
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
    
    //Editar        
    $(document).on("click", ".btnEditar", function(){		        
        opcion = 2;//editar
        fila = $(this).closest("tr");	        
        id_salida = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
        id_prod = fila.find('td:eq(1)').text();
        cantidad = fila.find('td:eq(2)').text();
        salida = fila.find('td:eq(3)').text();
        user = fila.find('td:eq(4)').text();
        $("#id_prod").val(id_prod);
        $("#cantidad").val(cantidad);
        $("#salida").val(salida);
        $("#user").val(user);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Salida");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        id_salida = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+id_salida+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/crudsalidas.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, id_salida:id_salida},    
              success: function() {
                  tablaSalidas.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    