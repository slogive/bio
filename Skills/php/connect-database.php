<?php
/*
define ('BD_SERVIDOR', 'localhost');
define ('BD_USUARIO', 'slogive');
define ('BD_CONTRASEÑA', 'SrFCf32026483@');
define ('BD_NOMBRE', 'slogive');

$conexion = mysqli_connect(BD_SERVIDOR, BD_USUARIO, BD_CONTRASEÑA, BD_NOMBRE);
    if ($conexion == false){
        die('Error en la conexión - ' .mysqli_connect_error());
    } else {
        echo 'Conexion exitosa';
    }
*/
	
	// Parametros a configurar para la conexion de la base de datos 
	$host = "localhost";
	$basededatos = "slogive";
	$usuariodb = "slogive";
	$clavedb = "SrFCf32026483@";
	
	error_reporting(1); // Sin Errores en Pantalla
	
	$conexion = new mysqli($host,$usuariodb,$clavedb,$basededatos);
	$conexion -> set_charset("utf8");

	if ($conexion->connect_errno) {
	    echo "Nuestro sitio experimenta fallos....";
	    exit();
	}
?>