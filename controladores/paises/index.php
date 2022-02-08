<?php

    include("modelos/paises/index.php");

    // seteo listado por default
    $accion = "listado";

    // si paso la variable a entonces..... la guardo en accion
    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }

    switch( $accion ){

        case "listadoAjax":
            //1- Obtener los datos de los paises (Pide al modelo de paises)       
            $data["registros"] = obtenerTodosPaises();

            //2- Va a llamar a la vista pasandole los datos de los paises (JSON)
            include( 'vistas/ajax/index.php');
     
            break;
        
        default:
            include( 'vistas/404/index.php');

    }