<?php
    
    // aca incluyo todas las llamadas a la base de datos
    include("modelos/stock/index.php");

    // seteo de variables por default cuando entro a la pagina
    $accion = "listado";
    $id = null;


     // si paso la variable id entonces..... la guardo en id
     // si tengo la variable id es porque vengo de VER o EDITAR
     if ( isset($_GET["id"]) ){
        $id = $_GET["id"];    
     } 


    // si paso la variable a entonces..... la guardo en accion pase este valor en la ruta
    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }

    switch( $accion ){
        
        case "dameStockDeposito":
            $data["registros"] = dameStockDeposito( $id ); 

            include( 'vistas/ajax/index.php');

            break;
           

        
        default:
            include( 'vistas/404/index.php');

    }

    