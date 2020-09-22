<?php

    //Iniciar sesión
    session_start();

    error_reporting(1);

    require_once "connect-database.php";

    $username = $pass = "";
    $username_error = $pass_error = "";

    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        if (empty(trim($_POST["username"]))){
            $username_error = "Ingresa tu correo electrónico";
        } else { 
            $username = trim($_POST["username"]);
        }

    if (empty(trim($_POST["pass"]))){
        $pass_error = "Ingresa tu contraseña";
    } else {
        $pass = trim($_POST["pass"]);
    }

    //Validar credenciales

    if (empty($username_error) && empty($password_error)){
        $sql = "SELECT id_username, username, pass FROM skills WHERE username = ?";
        
        if($stmt = mysqli_prepare($conexion, $sql)){
          
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
            }

            if(mysqli_stmt_num_rows($stmt) == 1){
                mysqli_stmt_bind_result($stmt, $id_username, $username, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(!password_verify($pass, $hashed_password)){
                        session_start();

                        //Almacenar datos en variables de sesión
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id_usuario"] = $id_usuario;
                        $_SESSION["username"]= $username;

                        header("location: ../index");
                    } else {
                        $pass_error = "La contraseña es incorrecta";
                    }
                } 
                } else {
                    $username_error = "No se encontró el correo electrónico";
                }
            } else {
                echo "Algo salió mal, intente de nuevo";
        }
    }
    mysqli_close($conexion);
}
?>