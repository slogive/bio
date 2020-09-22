<?php

    //Iniciar sesión
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: login.php");
        exit;
    }

    require_once "conexion.php";


    $correo= $contra= $passform="";
    $username_error = $password_error = "";

    

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (empty(trim($_POST["correo"]))){
            $correo_error = "Ingresa tu correo electrónico";
        } else {
            $correo = trim($_POST["correo"]);
        }

    if (empty(trim($_POST["pass"]))){
        $contra_error = "Ingresa tu contraseña";
    } else {
        $contra = trim($_POST["pass"]);
    }

    //Validar credenciales

    if (empty($correo_error) && empty($contra_error)){
        $sql = "SELECT id_usuario, nombre, apellido, telefono, fecha_nac, correo, contraseña FROM usuarios WHERE correo = ?";
        
        if($stmt = mysqli_prepare($conexion, $sql)){
          
            mysqli_stmt_bind_param($stmt, "s", $param_correo);
            $param_correo = $correo;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }

            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt,$id_usuario,$nombre,$apellido,$telefono,$fecha_nac, $correo,$hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($contra,$hashed_password)){
                        session_start();

                        //Almacenar datos en variables de sesión
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id_usuario"] = $id_usuario;
                        $_SESSION["correo"]= $correo;

                        header("location: usuario.php");
                    }else{
                        $contra_error = "La contraseña es incorrecta";
                    }
                } 
                }else{
                    $correo_error = "No se encontró el correo electrónico";
                }
            }else{
                echo "Algo salió mal, intente de nuevo";

        }
    }
    mysqli_close($conexion);
}
?>
