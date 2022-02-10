<?php

    include("modelos/clientes/index.php");
    include("modelos/ventas/index.php");
    include("modelos/productos/index.php");

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

    function validarDatos(){

        // estaba dando de alta y valido que ingrese por lo menos algun nombre minimo 3 caract
        // y que provincia y localidad tenga algun valor valido, default viene con -1
        return  true; /* isset( $_POST['nombre'] ) && strlen( trim($_POST['nombre']) ) >= 3  &&
                isset( $_POST['pais'] ) &&
                isset( $_POST['provincia'] ) && $_POST['provincia'] != '-1' &&
                isset( $_POST['id_localidad'] ) && $_POST['id_localidad'] != '-1'; */
               
    }

    switch( $accion ){

        case "detalleVentaAjax":
            //1- Obtener el detalle de la venta   
            
            $data["registros"] = obtenerPorIdVentas($_GET["id"]);
            
            include( 'vistas/ajax/index.php');

            break;

        case "listado":
            //1- Obtener los datos de los productos (Pide al modelo de productos)       
            $data["registros"] = obtenerTodosVentas();

            //2- Va a llamar a la vista pasandole los datos de los productos
            include( 'vistas/ventas/index.php');

            break;

        case "editar":
    
            //1. Verificar si viene con datos del formulario (payload)
            // aca hizo click en el boton GUARDAR ....ya vania editando
            if( isset( $_POST["cliente"] ) ){
                modificar($_POST, $id);

                header('Location: index.php?m=ventas&a=listado&mensaje=Venta modificada correctamente&tipoMensaje=success');
            }
            else{

                $data["clientes"] = obtenerTodosClientes();
                $data["productos"] = obtenerTodosProductos();

                //3. llamar a la vista pasandole los datos de esa venta en particular           
                include( 'vistas/ventas/index.php');
            }

            break;
        
        case "agregar":      
    
            // lo que viene por _POST lo tomo con file_get_contents
            // eso como es un json, con la funcion json_decode lo decodifico para leerlo en $postParams
            $postParams = json_decode( file_get_contents('php://input') );                     

            //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA
            if( isset( $postParams->cliente ) ){

                if ( validarDatos() ){                    
                    agregarVenta($postParams, $_SESSION['usuario']['id']);

                    $data["registros"] = ["status" => "OK", "message" => "La venta se registro satisfactoriamente"];                                        
                }else{
                    $data["registros"] = ["status" => "ERROR", "message" => "Error al guardar la venta"];
                }

                include( 'vistas/ajax/index.php');

            }else{        
                
                $data["clientes"] = obtenerTodosClientes();
                $data["productos"] = obtenerTodosProductos();

                //2. llamar a la vista del editor de venta vacio    
                include( 'vistas/ventas/index.php');
            }

            break;

        
        default:
            include( 'vistas/404/index.php');

    }
