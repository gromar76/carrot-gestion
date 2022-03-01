<?php

    include("modelos/localidades/index.php");

    // seteo listado por default
    $accion = "listado";

    // si paso la variable a entonces..... la guardo en accion
    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }


     // si paso la variable id entonces..... la guardo en id
     // si tengo la variable id es porque vengo de VER o EDITAR
     if ( isset($_GET["id"]) ){
        //guardo el id de la localidad
        $id = $_GET["id"];    
     } 



    switch( $accion ){

        case "listado":
            //1- Obtener los datos de las localidades (Pide al modelo de localidades)       
            $data["registros"] = obtenerTodosLocalidades2();

            //var_dump ( $data["registros"] ); exit();

            //2- Va a llamar a la vista pasandole los datos de las localidades
            include( 'vistas/localidades/index.php');

            break;


        case "listadoAjax":
            //1- Obtener los datos  (Pide al modelo)       
            $data["registros"] = obtenerPorIdLocalidades($_GET["id"]);

            //2- Va a llamar a la vista pasandole los datos de los paises (JSON)
            include( 'vistas/ajax/index.php');
        
            break;

        case "agregarAjax":
            
            $data["registros"] = agregarLocalidad($_GET["nombreLocalidad"], $_GET["idProvincia"]);

            //2- Va a llamar a la vista pasandole el id de la nueva localidad (JSON)
            include( 'vistas/ajax/index.php');
        
            break;

        case "editar":     
            //1. Verificar si viene con datos del formulario (payload)
            // aca hizo click en el boton GUARDAR ....ya venia editando

            //echo "holaaaa"; exit();


            if( isset( $_POST["nomLocalidad"] ) && trim( $_POST["nomLocalidad"] )!='' ){                   
                
                //modificarCatProd($_POST, $id);                    
                header('Location: index.php?m=localidades&a=listado&mensaje=Localidad modificada correctamente&tipoMensaje=success');                }
            else{

                //2. obtener datos del producto a editar
                // aca hizo click en el boton verde de editar
                $data["registros"]  = obtenerPorIdLocalidad2($id);   
                
                //var_dump ( $data["registros"] ); exit();

                //3. llamar a la vista pasandole los datos de ese cliente en particular           
                include( 'vistas/localidades/index.php');
            }

            break;



        
        default:
            include( 'vistas/404/index.php');

    }