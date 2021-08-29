$(document).ready(function() {
    var id_entrada, opcion;
    opcion = 4;
    
    tablaEntradas = $('#tablaEntradas').DataTable({
        "ajax":{
            "url": "bd/crudentradas.php",
            "method": 'POST', //usamos el metodo POST
            "data":{opcion:opcion}, //enviamos opcion 4 para que haga un SELECT
            "dataSrc":""
        },
        "columns":[
            {"data": "id_entrada"},
            {"data": "id_prod"},
            {"data": "cantidad"},
            {"data": "entrada"},
            {"data": "caducidad"},
            {"data": "user"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='material-icons'>edit</i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='material-icons'>delete</i></button></div></div>"}
        ]
    });
    
    var fila; //captura la fila, para editar o eliminar
    //submit para el Alta y Actualización
    $('#formEntradas').submit(function(e){
        e.preventDefault(); //evita el comportambiento normal del submit, es decir, recarga total de la página
        id_prod = $.trim($('#id_prod').val());
        cantidad = $.trim($('#cantidad').val());
        entrada = $.trim($('#entrada').val());
        caducidad = $.trim($('#caducidad').val());
        user = $.trim($('#user').val());
            $.ajax({
              url: "bd/crudentradas.php",
              type: "POST",
              datatype:"json",
              data:  {id_entrada:id_entrada, id_prod:id_prod, cantidad:cantidad, entrada:entrada, caducidad:caducidad, user:user,opcion:opcion},
              success: function(data) {
                tablaEntradas.ajax.reload(null, false);
                }
            });
        $('#modalCRUD').modal('hide');
    });
    
    //para limpiar los campos antes de dar de Alta una Persona
    $("#btnNuevo").click(function(){
        opcion = 1; //alta
        id_entrada=null;
        $("#formEntradas").trigger("reset");
        $(".modal-header").css( "background-color", "#17a2b8");
        $(".modal-header").css( "color", "white" );
        $(".modal-title").text("Registrar Entrada");
        $('#modalCRUD').modal('show');
    });
    
    //Editar
    $(document).on("click", ".btnEditar", function(){
        opcion = 2;//editar
        fila = $(this).closest("tr");
        id_entrada = parseInt(fila.find('td:eq(0)').text()); //capturo el ID
        id_prod = fila.find('td:eq(1)').text();
        cantidad = fila.find('td:eq(2)').text();
        entrada = fila.find('td:eq(3)').text();
        caducidad = fila.find('td:eq(4)').text();
        user = fila.find('td:eq(5)').text();
        $("#id_prod").val(id_prod);
        $("#cantidad").val(cantidad);
        $("#entrada").val(entrada);
        $("#caducidad").val(caducidad);
        $("#user").val(user);
        $(".modal-header").css("background-color", "#007bff");
        $(".modal-header").css("color", "white" );
        $(".modal-title").text("Editar Entrada");
        $('#modalCRUD').modal('show');
    });
    
    //Borrar
    $(document).on("click", ".btnBorrar", function(){
        fila = $(this);
        id_entrada = parseInt($(this).closest('tr').find('td:eq(0)').text()) ;
        opcion = 3; //eliminar
        var respuesta = confirm("¿Está seguro de borrar el registro "+id_entrada+"?");
        if (respuesta) {
            $.ajax({
              url: "bd/crudentradas.php",
              type: "POST",
              datatype:"json",
              data:  {opcion:opcion, id_entrada:id_entrada},
              success: function() {
                  tablaEntradas.row(fila.parents('tr')).remove().draw();
                }
            });
        }
    });
});    