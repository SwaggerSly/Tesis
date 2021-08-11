<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id_prod = (isset($_POST['id_prod'])) ? $_POST['id_prod'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$entrada = (isset($_POST['entrada'])) ? $_POST['entrada'] : '';
$caducidad = (isset($_POST['caducidad'])) ? $_POST['caducidad'] : '';
$user = (isset($_POST['user'])) ? $_POST['user'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_entrada = (isset($_POST['id_entrada'])) ? $_POST['id_entrada'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO entradas (id_prod, cantidad, entrada, caducidad, user) VALUES('$id_prod', '$cantidad', '$entrada', '$caducidad', '1') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM entradas ORDER BY id_entrada DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE entradas SET id_prod='$id_prod', cantidad='$cantidad', entrada='$entrada', caducidad='$caducidad', user='1' WHERE id_entrada='$id_entrada' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM entradas WHERE id_entrada='$id_entrada' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM entradas WHERE id_entrada='$id_entrada' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM entradas";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;