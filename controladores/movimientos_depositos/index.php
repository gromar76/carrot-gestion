<?php

    include("modelos/movimientos_depositos/index.php");

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

    $idUsuarioActivo = NULL;
    if ( $_SESSION['usuario'] ){
        $idUsuarioActivo = $_SESSION['usuario']['id'];
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

/*        case "detalleCompraAjax":
            //1- Obtener el detalle de la compra   
            
            $data["registros"] = obtenerPorIdCompra($_GET["id"]);
            
            include( 'vistas/ajax/index.php');

            break; */

        case "listado":

            //1- Obtener los datos de las  movimientos entre depositos (Pide al modelo de movimientos depositos)       
            $data["registros"] = obtenerTodosMovimientosDepositos();

            //2- Va a llamar a la vista pasandole los datos de los movimientos entre depositos
            include( 'vistas/movimientos_depositos/index.php');

            break;

/*        case "editarAjax":
    
            //1. Verificar si viene con datos del formulario (payload)
            // aca hizo click en el boton GUARDAR ....ya venia editando
            $putParams = json_decode( file_get_contents('php://input') );                     
           
            if( isset( $_GET["id"] ) ){            
        
                modificarCompra( $_GET["id"] , $putParams, $idUsuarioActivo );

                $data["registros"] = ["status" => "OK", "message" => "La compra se ha modificado correctamente."];

                include( 'vistas/ajax/index.php');
            
            }else{
                //REFACTOR  -> VALIDAR
            }

            break;
        
        case "ver":
        case "editar":
          
            //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA


            $data["proveedores"] = obtenerTodosProveedores();
            $data["depositos"]    = obtenerTodosDepositos();     
            $data["productos"] = obtenerTodosProductosxOrdenManual();
            
            //3. llamar a la vista pasandole los datos de esa compra en particular           
            include( 'vistas/compras/index.php');
       

            break;
        
        case "agregar":
       
            // lo que viene por _POST lo tomo con file_get_contents
            // eso como es un json, con la funcion json_decode lo decodifico para leerlo en $postParams
            $postParams = json_decode( file_get_contents('php://input') );

            //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA
            if( isset( $postParams->proveedor ) ){

                if ( validarDatos() ){                    
                    agregarCompra($postParams, $idUsuarioActivo );

                    $data["registros"] = ["status" => "OK", "message" => "La compra se registro satisfactoriamente"];                                        
                }else{
                    $data["registros"] = ["status" => "ERROR", "message" => "Error al guardar la compra"];
                }

                include( 'vistas/ajax/index.php');

            }else{        
                
                $data["proveedores"]  = obtenerTodosProveedores();       
                $data["depositos"]    = obtenerTodosDepositos();     
                $data["deposito"]     = obtenerDepositoDefault( $idUsuarioActivo ); 
                
                //$data["productos"] = obtenerTodosProductos();
                $data["productos"] = obtenerTodosProductosxOrdenManual(); 
               
                //2. llamar a la vista del editor de compra vacio    
                include( 'vistas/compras/index.php');
            }

            break;

        case "eliminar":
            eliminarCompra( $_GET["id"] );

            $data["registros"] = ["status" => "OK", "message" => "La compra se ha eliminado correctamente."];

            include( 'vistas/ajax/index.php');

            break;  */
        
        default:
            include( 'vistas/404/index.php');

    }
