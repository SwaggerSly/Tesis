$(document).ready(function() {
    var id_prod, opcion;
    opcion = 4;
        
    tablaProductos = $('#tablaProductos').DataTable({  
        "ajax":{            
            "url": "bd/crudproductos.php", 
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "id_prod"},
            {"data": "nombre_prod"},
            {"data": "area"},
            {"data": "descripcion"},
            {"data": "id_categoria"},
            {"data": "estock_min"},
            {"data": "unidad"},
            {"data": "existencia"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
        ]
    });     
    
    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#formProductos').submit(function(e){                         
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        nombre_prod = $.trim($('#nombre_prod').val());    
        area = $.trim($('#area').val());
        descripcion = $.trim($('#descripcion').val());    
        id_categoria = $.trim($('#id_categoria').val());    
        estock_min = $.trim($('#estock_min').val());
        unidad = $.trim($('#unidad').val());
        existencia = $.trim($('existencia').val());                            
            $.ajax({
              url: "bd/crudproductos.php",
              type: "POST",
              datatype:"json",    
              data:  {id_prod:id_prod, nombre_prod:nombre_prod, area:area, descripcion:descripcion, id_categoria:id_categoria, estock_min:estock_min ,unidad:unidad ,existencia:existencia, opcion:opcion},    
              success: function(data) {
                tablaProductos.ajax.reload(null, false);
               }
            });			        
        $('#modalCRUD').modal('hide');											     			
    });
            
     
    
    //para limpiar los campos antes de dar de Alta una Persona
    $("#btnNuevo").click(function(){
        opcion = 1; //alta           
        id_prod=null;
        $("#formProductos").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Alta de Usuario");
        $('#modalCRUD').modal('show');	    
    });
    
    //Editar        
    $(document).on("click", ".btnEditar", function(){		        
        opcion = 2;//editar
        fila = $(this).closest("tr");	        
        id_prod = parseInt(fila.find('td:eq(0)').text()); //capturo el ID		            
        nombre_prod = fila.find('td:eq(1)').text();
        area = fila.find('td:eq(2)').text();
        descripcion = fila.find('td:eq(3)').text();
        id_categoria = fila.find('td:eq(4)').text();
        estock_min = fila.find('td:eq(5)').text();
        unidad = fila.find('td:eq(6)').text();
        existencia = fila.find('td:eq(7)').text();        
        $("#nombre_prod").val(nombre_prod);
        $("#area").val(area);
        $("#descripcion").val(descripcion);
        $("#id_categoria").val(id_categoria);
        $("#estock_min").val(estock_min);
        $("#unidad").val(unidad);
        $("#existencia").val(existencia);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Usuario");		
        $('#modalCRUD').modal('show');		   
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);           
        id_prod = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;		
        opcion = 3; //eliminar        
        var respuesta = confirm("¿Está seguro de borrar el registro "+id_prod+"?");                
        if (respuesta) {            
            $.ajax({
              url: "bd/crudproductos.php",
              type: "POST",
              datatype:"json",    
              data:  {opcion:opcion, id_prod:id_prod},    
              success: function() {
                  tablaProductos.row(fila.parents('tr')).remove().draw();                  
               }
            });	
        }
     });
         
    });    