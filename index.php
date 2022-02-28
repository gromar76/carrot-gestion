<?php
    session_start(); //Inicio de sesion

    // por default pongo la variable modulo con login
    $modulo = "login"; //default

    // si envio por get la variable m (modelo) entonces asignasela a modulo
    if ( isset( $_GET['m'] ) ) {
        $modulo =  $_GET['m'] ;
    }

    if ( isset( $_GET['mensaje'] ) ){
        $data["mensaje"] = $_GET['mensaje'] ;
        $data["tipoMensaje"] =  $_GET['tipoMensaje'];
    } 

    if ( isset( $_SESSION['usuario'] ) ) {
        $data['usuario'] = $_SESSION['usuario'];
    }else{
        //No hizo login
        $modulo = "login";
    }

    
    // vengo del index.php principal y el controlador sabe para donde debe dirigirse

    switch( $modulo ){

        case "clientes":
            $modulo = "clientes";
            break;

        case "productos":
            $modulo = "productos";
            break;

        case "ventas":
            $modulo = "ventas";
            break;

        case "localidades":
            $modulo = "localidades";
            break;

        case "categorias":
            $modulo = "categorias";
             break;
           
        case "login":
            $modulo = "login";
            break;

        case "logout":
            $modulo = "logout";
            break;

        case "paises":
            $modulo = "paises";
            break;

        case "provincias":
            $modulo = "provincias";
            break;
        
        case "depositos":
            $modulo = "depositos";
            break;
        
        case "pagos":
            $modulo = "pagos";
            break;

        case "egresos":
            $modulo = "egresos";
            break;
    
        
        // si modulo no es ninguno de los anteriores entonces es 404
        default: 
            $modulo = "404";
            break;

    }

    include("controladores/" . $modulo . "/index.php");
    
