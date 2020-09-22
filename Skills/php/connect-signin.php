<?php
    /*Incluir archivo de conexion a BD*/ 
    require_once "connect-database.php";

    //Definir variables e inicializarlas
    $username = $email = $pass = "";
    $username_error = $email_error = $pass_error = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST"){

        //Validar username
        if(empty(trim($_POST["username"]))){
            $username_error = "Ingrese su username";
            } else {
                //consulta de seleccion
                $sql= "SELECT id_username FROM skills WHERE username = ?";
                
                if($stmt = mysqli_prepare($conexion, $sql)){
                    mysqli_stmt_bind_param($stmt, "s", $param_username);
    
                    $param_username = trim($_POST["username"]);
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_store_result($stmt);
    
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $username_error = "Usuario ya existente";
                        } else {
                            $username = trim($_POST["username"]);
                        }
                    } else {
                        $email_error_failure = "Algo salió mal con el Email tio, inténtalo más tarde";
                    }
                }
            }

        /*
        //Validar username
        if(empty(trim($_POST["username"]))){
        $username_error = "Ingrese su username";
        } else { 
            //consulta de seleccion
            $sql= "SELECT id_username FROM skills WHERE username = ?";
            
            if($stmt = mysqli_prepare($conexion, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = trim($_POST["username"]);
                if(mysqli_stmt_execute($stmt)){
                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        $username_error = "Usuario ya existente";
                    } else {
                        $username = trim($_POST["username"]);
                    }
                } else {
                    echo "Algo salió mal, inténtalo más tarde";
                }
            }
        }*/

        //Validar email
        if(empty(trim($_POST["email"]))){
            $email_error = "Ingrese su email";
            } else {
                //consulta de seleccion
                $sql= "SELECT id_username FROM skills WHERE email = ?";
                
                if($stmt = mysqli_prepare($conexion, $sql)){
                    mysqli_stmt_bind_param($stmt, "s", $param_email);
    
                    $param_email = trim($_POST["email"]);
                    if(mysqli_stmt_execute($stmt)){
                        mysqli_stmt_store_result($stmt);
    
                        if(mysqli_stmt_num_rows($stmt) == 1){
                            $email_error = "Email ya existente";
                        } else {
                            $email = trim($_POST["email"]);
                        }
                    } else {
                        echo "Algo salió mal, inténtalo más tarde";
                    }
                }
            }

        //Validar pass
        if(empty(trim($_POST["pass"]))){
            $pass_error = "Ingrese su contraseña";
            } elseif (strlen(trim($_POST["pass"]))<4){
                $pass_error = "La contraseña debe tener al menos 4 caracteres";
            } else {
                $pass = trim($_POST["pass"]);
            }

            //Comprobar que variables de error están vacías
            if (empty ($username_error) && empty ($email_error) && empty ($pass_error)){

                    $sql = "INSERT INTO skills (username, email, pass)
                            VALUES (?,?,?)";
                    if ($stmt = mysqli_prepare ($conexion, $sql)){
                        mysqli_stmt_bind_param($stmt, "ssssss", $param_username, $param_email, $param_pass);

                        //estableciendo parámetros
                        $param_username = $username;
                        $param_email = $email;
                        $param_pass = password_hash($pass, PASSWORD_DEFAULT); //contraseña encriptada

                        if(mysqli_stmt_execute($stmt)){
                            header("location: login.php");
                        } else {
                            echo "Algo salió mal, intente de nuevo";
                        }
                    }
                }
        mysqli_close($conexion);
    }
?>