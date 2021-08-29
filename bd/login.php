<?php
session_start();

include_once 'conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
//El comando de abajo se puede utilizar para hacer una prueba de la conexión (para su uso se deben comentar todas las lineas debajo de la línea de abajo)
//print_r($conexion);
//recepción de datos enviados mediante POST desde ajax
$usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : '';
$password = (isset($_POST['password'])) ? $_POST['password'] : '';

$pass = md5($password); //encripto la clave enviada por el usuario para compararla con la clava encriptada y almacenada en la BD
//La siguiente consulta se puede sustituir por la línea 17, pero se debe de comentar las línea 17, 25 y 26 y la línea 4 y 5 del documento logout.php
//$consulta = "SELECT * FROM users WHERE usuario='$usuario' AND password='$pass' ";

$consulta = "SELECT users.idRol AS idRol, roles.descripcion AS rol FROM users JOIN roles ON users.idRol = users.id WHERE usuario='$usuario' AND password='$pass' ";

$resultado = $conexion->prepare($consulta);
$resultado->execute();

if($resultado->rowCount() >= 1){
    $data = $resultado->fetchAll(PDO::FETCH_ASSOC);
    $_SESSION["s_usuario"] = $usuario;
    $_SESSION["s_idRol"] = $data [0]["idRol"];
    $_SESSION["s_rol_descripcion"] = $data [0]["rol"];
}else{
    $_SESSION["s_usuario"] = null;
    $data=null;
}

print json_encode($data);
$conexion=null;