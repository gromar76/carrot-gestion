<?php

    include("modelos/ventas/index.php");

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
            //1- Obtener los datos de los productos (Pide al modelo de productos)       
            $data["registros"] = obtenerTodosVentas();

            //2- Va a llamar a la vista pasandole los datos de los productos
            include( 'vistas/ventas/index.php');

            break;

            case "editar":
     
                //1. Verificar si viene con datos del formulario (payload)
                // aca hizo click en el boton GUARDAR ....ya vania editando
                if( isset( $_POST["nombre"] ) ){
                    modificar($_POST, $id);
    
                    header('Location: index.php?m=ventas&a=listado&mensaje=Venta modificada correctamente&tipoMensaje=success');
                }
                else{
    
                    //2. obtener datos del producto a editar
                    // aca hizo click en el boton verde de editar
                    $data["registros"] = obtenerPorId($id);                   
    
                    //3. llamar a la vista pasandole los datos de ese cliente en particular           
                    include( 'vistas/ventas/index.php');
                }
    
                break;
        
            case "agregar":      
        
                //1. Verificar si viene con datos del formulario (payload)
                //APRETE BOTON GUARDAN DANDO DE ALTA
                if( isset( $_POST["nombre"] ) ){
    
                   // if ( validarDatos() ){
                        agregar($_POST, $_SESSION['usuario']['id']);
    
                        header('Location: index.php?m=ventas&a=listado&mensaje=Venta agregada correctamente&tipoMensaje=success');
                   /*  }else{
    
                        $data["mensaje"] = 'Completar todos los campos obligatorios';
                        $data["tipoMensaje"] = 'danger';
    
                        $data["registros"]["nombre"] = $_POST['nombre'] ?  $_POST['nombre'] : '';
                        $data["registros"]["apellido"] = $_POST['apellido'] ?  $_POST['apellido'] : '';

        
                        include( 'vistas/clientes/index.php');
                    } */
    
                }else{                  
                    //2. llamar a la vista pasandole los datos de ese cliente en particular           
                    include( 'vistas/ventas/index.php');
                }
    
                break;

        
        default:
            include( 'vistas/404/index.php');

    }
