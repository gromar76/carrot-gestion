<?php

    include("modelos/pruebas/index.php");

    // seteo listado por default
    $accion = "nico";

    // si paso la variable a entonces..... la guardo en accion
    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }

    switch( $accion ){

        case "mag":

            echo "hola mag";

            //1- Obtener los datos de los paises (Pide al modelo de paises)       
            $data["registros"] = dameTodosCompradoresMag();
            var_dump( $data["registros"] );
            exit();
            //2- Va a llamar a la vista pasandole los datos de los paises (JSON)
            include( 'vistas/pruebas/index.php');
     
            break;

        case "nico":

            echo "hola nico";
            
            //1- Obtener los datos de los paises (Pide al modelo de paises)       
            $data["registros"] = dameTodosClientes(); 
            
            var_dump( $data["registros"] );
            exit();
            
            //2- Va a llamar a la vista pasandole los datos de los paises (JSON)
            include( 'vistas/pruebas/index.php');        
            
            break;
        
        default:
            include( 'vistas/404/index.php');

    }