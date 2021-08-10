$(document).ready(function() {
    var id_categoria, opcion;
    opcion = 4;
        
    tablaCategorias = $('#tablaCategorias').DataTable({  
        "ajax":{            
            "url": "bd/crudcategorias.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "id_categoria"},
            {"data": "nombre"},
            {"data": "descripcion"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
        ]
    });     
    
    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#formCategorias').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        nombre = $.trim($('#nombre').val());    
        descripcion = $.trim($('#descripcion').val());                            
            $.ajax({
              url: "bd/crudcategorias.php",
              type: "POST",
              datatype:"json",    
              data:  {id_categoria:id_categoria, nombre:nombre, descripcion:descripcion,opcion:opcion},    
              success: function(data) {
                tablaCategorias.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta una Persona
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        id_categoria=null;
        $("#formCategorias").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta Categoria");
        $('#modalCRUD').modal('show');	    
    });
    
    //Editar        
    $(document).on("click", ".btnEditar", function(){		        
        opcion = 2;//editar
        fila = $(this).closest("tr");	        
        id_categoria = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
        nombre = fila.find('td:eq(1)').text();
        descripcion = fila.find('td:eq(2)').text();
        $("#nombre").val(nombre);
        $("#descripcion").val(descripcion);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Categoria");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        id_categoria = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+id_categoria+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/crudcategorias.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, id_categoria:id_categoria},    
              success: function() {
                  tablaCategorias.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    