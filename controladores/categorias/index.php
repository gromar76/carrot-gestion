<?php

    include("modelos/categorias_productos/index.php");

    // seteo listado por default
    $accion = "listado";
    $id = null;


     // si paso la variable id entonces..... la guardo en id
     if ( isset($_GET["id"]) ){
        $id = $_GET["id"];    
     } 


    // si paso la variable a entonces..... la guardo en accion
    if ( isset($_GET["a"]) ){
        $accion = $_GET["a"];
    }

    switch( $accion ){

        case "listado":
            //1- Obtener los datos de los clientes (Pide al modelo de clientes)       
            $data["registros"] = obtenerTodosCatProd();

            //2- Va a llamar a la vista pasandole los datos de los clientes
            include( 'vistas/categorias/index.php');

            break;



            case "editar":     
                //1. Verificar si viene con datos del formulario (payload)
                // aca hizo click en el boton GUARDAR ....ya venia editando
                if( isset( $_POST["nombre"] ) ){
                    modificar($_POST, $id);    
                    header('Location: index.php?m=categorias&a=editar&mensaje=Categoria modificada correctamente&tipoMensaje=success');                }
                else{
    
                    //2. obtener datos del producto a editar
                    // aca hizo click en el boton verde de editar
                    $data["registros"]  = obtenerPorIdCatProd($id);                  
                    
    

                    //3. llamar a la vista pasandole los datos de ese cliente en particular           
                    include( 'vistas/categorias/index.php');
                }
    
                break;


           
               
        default:
            include( 'vistas/404/index.php');

    }
