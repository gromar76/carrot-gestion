<?php

    include("modelos/localidades/index.php");

    // seteo listado por default
    $accion = "listado";

    // si paso la variable a entonces..... la guardo en accion
    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }

    switch( $accion ){

        case "listado":
            //1- Obtener los datos de los clientes (Pide al modelo de clientes)       
            $data["registros"] = obtenerTodosLocalidades();

            //2- Va a llamar a la vista pasandole los datos de los clientes
            include( 'vistas/localidades/index.php');

            break;


        case "listadoAjax":
            //1- Obtener los datos de los paises (Pide al modelo de paises)       
            $data["registros"] = obtenerPorIdLocalidades($_GET["id"]);

            //2- Va a llamar a la vista pasandole los datos de los paises (JSON)
            include( 'vistas/ajax/index.php');
        
            break;

        case "agregarAjax":
            
            $data["registros"] = agregarLocalidad($_GET["nombreLocalidad"], $_GET["idProvincia"]);

            //2- Va a llamar a la vista pasandole el id de la nueva localidad (JSON)
            include( 'vistas/ajax/index.php');
        
            break;



        
        default:
            include( 'vistas/404/index.php');

    }