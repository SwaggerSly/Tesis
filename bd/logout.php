<?php
session_start();
unset($_SESSION["s_usuario"]);
unset($_SESSION["s_idRol"]);
unset($SESSION["s_rol_descripcion"]);
//las líneas 4 y 5 es para la validación de usuarios con respecto a su rol.
session_destroy();
header("Location: ../login.php");
?>