<?php    
    include("modelos/auth/index.php");

    $accion = "logout";

    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }

    switch( $accion ){

        case "logout":

            session_destroy();
            //Si no esta ok (Vuelvo al login) 
            header('Location: index.php?m=login');

            break;
        
        default:
            include( 'vistas/404/index.php');

    }