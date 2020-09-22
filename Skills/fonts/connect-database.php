<?php
error_reporting(0);

define ('BD_SERVIDOR', 'localhost');
define ('BD_USUARIO', 'slogive');
define ('BD_CONTRASEÑA', 'SrFCf32026483@');
define ('BD_NOMBRE', 'Slogive');

$conexion = mysqli_connect(BD_SERVIDOR, BD_USUARIO, BD_CONTRASEÑA, BD_NOMBRE);
    if ($conexion == false){
        die('Error en la conexión - ' .mysqli_connect_error());
    } else {
        echo 'Conexion exitosa';
    }
?>