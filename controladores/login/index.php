<?php

    include("modelos/auth/index.php");

    $accion = "login";

    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }

    switch( $accion ){

        case "login":

            if ( isset( $_SESSION['usuario'] ) ){
                header('Location: index.php?m=clientes');
            }else{

                if ( isset($_POST["email"]) &&  isset($_POST["password"])  ){
                    //Valido al usuario
                    $usuario = validarUsuario($_POST["email"], $_POST["password"]);
                    
                    //Si esta ok (Redirigimos al modulo clientes)
                    if ( $usuario ){
                        $_SESSION['usuario'] = $usuario;

                        header('Location: index.php?m=clientes');
                    }else{
                        //Si no esta ok (Vuelvo al login) 
                        $mensaje = "Usuario y/o contraseña incorrecta";
                        $tipoMensaje = "danger";

                        header("Location: index.php?m=login&mensaje=$mensaje&tipoMensaje=$tipoMensaje");
                    }
                }
                else{
                    include( 'vistas/login/index.php');
                }
            }

            break;
        
        default:
            include( 'vistas/404/index.php');

    }