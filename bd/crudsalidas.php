<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

$id_prod = (isset($_POST['id_prod'])) ? $_POST['id_prod'] : '';
$cantidad = (isset($_POST['cantidad'])) ? $_POST['cantidad'] : '';
$dia = (isset($_POST['dia'])) ? $_POST['dia'] : '';
$mes = (isset($_POST['mes'])) ? $_POST['mes'] : '';



$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
$id_salida = (isset($_POST['id_salida'])) ? $_POST['id_salida'] : '';


switch($opcion){
    case 1:
        $consulta = "INSERT INTO salidas (id_prod, cantidad, dia, mes) VALUES('$id_prod', '$cantidad', '$dia', '$mes') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 
        
        $consulta = "SELECT * FROM salidas ORDER BY id_salida DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);       
        break;    
    case 2:        
        $consulta = "UPDATE salidas SET id_prod='$id_prod', cantidad='$cantidad', dia='$dia', mes='$mes' WHERE id_salida='$id_salida' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT * FROM salidas WHERE id_salida='$id_salida' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 3:        
        $consulta = "DELETE FROM salidas WHERE id_salida='$id_salida' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;
    case 4:    
        $consulta = "SELECT * FROM salidas";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
}

print json_encode($data, JSON_UNESCAPED_UNICODE);//envio el array final el formato json a AJAX
$conexion=null;