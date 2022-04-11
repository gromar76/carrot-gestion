<?php

    include("modelos/pruebas/index.php");

    // seteo listado por default
    $accion = "prueba1";

    // si paso la variable a entonces..... la guardo en accion
    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }

    switch( $accion ){

        case "prueba1":
            //1- Obtener los datos de los paises (Pide al modelo de paises)       
            $data["registros"] = todosclientes();   

            //2- Va a llamar a la vista pasandole los datos de los paises (JSON)
            include( 'vistas/pruebas/index.php');
     
            break;
        
        default:
            include( 'vistas/404/index.php');

    }