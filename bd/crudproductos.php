<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$nombre_prod = (isset($_POST['nombre_prod'])) ? $_POST['nombre_prod'] : '';
$area = (isset($_POST['area'])) ? $_POST['area'] : '';
$descripcion = (isset($_POST['descripcion'])) ? $_POST['descripcion'] : '';
$id_categoria = (isset($_POST['id_categoria'])) ? $_POST['id_categoria'] : '';
$estock_min = (isset($_POST['estock_min'])) ? $_POST['estock_min'] : '';
$unidad = (isset($_POST['unidad'])) ? $_POST['unidad'] : '';
$existencia = (isset($_POST['existencia'])) ? $_POST['existencia'] : '';


$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_prod = (isset($_POST['id_prod'])) ? $_POST['id_prod'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO productos (nombre_prod, area, descripcion, id_categoria, estock_min, unidad, existencia) VALUES('$nombre_prod', '$area', '$descripcion', '$id_categoria', '$estock_min', '$unidad', '$existencia') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM productos ORDER BY id_prod DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE productos SET nombre_prod='$nombre_prod', area='$area', descripcion='$descripcion', id_categoria='$id_categoria', estock_min='$estock_min', unidad='$unidad', existencia='$existencia' WHERE id_prod='$id_prod' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM productos WHERE id_prod='$id_prod' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM productos WHERE id_prod='$id_prod' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM productos";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;