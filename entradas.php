<?php
session_start();

if($_SESSION["s_usuario"] === null){
    header("Location: ../index.php");
    include_once '../bd/conexion.php';
}
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>Entradas</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <!-- <link rel="stylesheet" href="main.css">   -->
      
      
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="assets/datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="assets/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">    
      
    <!-- Iconos y fuentes -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">  
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>

    <style>
        body{
        background-color:#ffffff;
        
        }
        table.dataTable thead {
            background: linear-gradient(to right, #f12711, #f5af19);
            color:white;
        }

        .caja{
        /* border: 1px solid; */
        padding: 5px;
        box-shadow: 10px 10px 50px 1px #7c7c81;
        border-radius: 10px;
        }
        .bg {
            background: linear-gradient(to right, #f12711, #f5af19);
        }
    </style>
  </head>
    
  <body> 
     <header>
     <!-- NavBar -->
     <nav id="myLinks" class="navbar navbar-expand-sm navbar-dark bg">
        <div class="container-fluid">
            <a class="navbar-brand" href="categorias.php">Categorías</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                <a class="nav-link" aria-current="page" href="productos.php">Productos</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="entradas.php">Entradas</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="salidas.php">Salidas</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">Usuario  <span class="badge badge-light"><?php echo $_SESSION["s_usuario"];?></span></a>
                </li>
                <li>
                <a class="btn btn-danger" href="/Tesis/bd/logout.php" role="button"><i class='bx bx-log-out' id="log_out" ></i>
                </a>
                </li>
            </ul>
            </div>
        </div>
     </nav>
     </header>    
    <br>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
            <button id="btnNuevo" type="button" class="btn btn-info" data-toggle="modal"><i class="material-icons">library_add</i></button>    
            </div>    
        </div>    
    </div>    
    <br>  

    <div class="container caja">
        <div class="row">
            <div class="col-lg-12">
            <div class="table-responsive">        
                <table id="tablaEntradas" class="table table-striped table-bordered table-condensed" style="width:100%" >
                    <thead class="text-center">
                        <tr>
                            <th>Id</th>
                            <th>Id del Producto</th>
                            <th>Cantidad</th>                                
                            <th>Fecha de Entrada</th>
                            <th>Caducidad</th>
                            <th>Usuario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>                           
                    </tbody>        
                </table>               
            </div>
            </div>
        </div> 
    </div>   

<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formEntradas">    
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-3">
                    <div class="form-group">
                    <label for="" class="col-form-label">Id_Producto</label>
                    <input type="number" class="form-control" id="id_prod">
                    </div>
                    </div>
                    <div class="col-lg-3">
                    <div class="form-group">
                    <label for="" class="col-form-label">Cantidad</label>
                    <input type="number" class="form-control" id="cantidad">
                    </div> 
                    </div>    
                </div>
                <div class="row"> 
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Fecha de Entrada</label>
                    <input type="date" class="form-control" id="entrada">
                    </div>               
                    </div>
                    <div class="col-lg-6">
                    <div class="form-group">
                    <label for="" class="col-form-label">Caducidad</label>
                    <input type="date" class="form-control" id="caducidad">
                    </div>               
                    </div> 
                </div>                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>  
      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="assets/jquery/jquery-3.3.1.min.js"></script>
    <script src="assets/popper/popper.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="assets/datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="mainEntradas.js"></script>  
    
    
  </body>
</html>
