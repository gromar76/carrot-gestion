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

        case "resumenVentasAjax":
            $filtroCliente        = isset($_GET["cli"])   ? $_GET["cli"]   : null;
            $filtroDesde          = isset($_GET["desde"]) ? $_GET["desde"] : date("Y-m-d", strtotime(date("Y-m-d")."- 30 day"));
            $filtroHasta          = isset($_GET["hasta"]) ? $_GET["hasta"] : null;
            $filtroSoloPendientes = isset($_GET["sp"])    ? $_GET["sp"]    : 'false';
            $filtroUsuario        = isset($_GET["usr"])    ? $_GET["usr"]    : '-1';

            $data["registros"] = obtenerResumenVentas($filtroCliente, $filtroDesde, $filtroHasta, $filtroSoloPendientes, $filtroUsuario);
            
            include( 'vistas/ajax/index.php');

            break;

        case "detalleVentaAjax":
            //1- Obtener el detalle de la venta   
            
            $data["registros"] = obtenerPorIdVentas($_GET["id"]);
            
            include( 'vistas/ajax/index.php');

            break;

        case "listado":

            $filtroCliente        = isset($_GET["cli"])   ? $_GET["cli"]   : null;
            $filtroDesde          = isset($_GET["desde"]) ? $_GET["desde"] : date("Y-m-d", strtotime(date("Y-m-d")."- 30 day"));
            $filtroHasta          = isset($_GET["hasta"]) ? $_GET["hasta"] : null;
            $filtroSoloPendientes = isset($_GET["sp"])    ? $_GET["sp"]    : 'false';
            $filtroUsuario        = isset($_GET["usr"])    ? $_GET["usr"]    : '-1';

            //1- Obtener los datos de los productos (Pide al modelo de productos)       
            $data["registros"] = obtenerTodosVentas($filtroCliente, $filtroDesde, $filtroHasta, $filtroSoloPendientes, $filtroUsuario  );
            $data["filtroDesde"] = $filtroDesde;
            $data["filtroHasta"] = $filtroHasta;
            $data["filtroSoloPendientes"] = $filtroSoloPendientes;
            $data['filtroUsuario'] = $filtroUsuario;

            //2- Va a llamar a la vista pasandole los datos de los productos
            include( 'vistas/ventas/index.php');

            break;

        case "editarAjax":
    
            //1. Verificar si viene con datos del formulario (payload)
            // aca hizo click en el boton GUARDAR ....ya vania editando
            $putParams = json_decode( file_get_contents('php://input') );                     
           
            if( isset( $_GET["id"] ) ){            
        
                modificarVenta( $_GET["id"] , $putParams, $_SESSION['usuario']['id']);

                $data["registros"] = ["status" => "OK", "message" => "La venta se ha modificado correctamente."];

                include( 'vistas/ajax/index.php');
            
            }else{
                //REFACTOR  -> VALIDAR
            }

            break;

        case "ver":
        case "editar":
          
            //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA


            $data["clientes"] = obtenerTodosClientes();
            //$data["productos"] = obtenerTodosProductos();
            $data["productos"] = obtenerTodosProductosxOrdenManual();
            
            //3. llamar a la vista pasandole los datos de esa venta en particular           
            include( 'vistas/ventas/index.php');
       

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
                
                //$data["productos"] = obtenerTodosProductos();
                $data["productos"] = obtenerTodosProductosxOrdenManual();

                //2. llamar a la vista del editor de venta vacio    
                include( 'vistas/ventas/index.php');
            }

            break;

        case "eliminar":
            eliminarVenta( $_GET["id"] );

            $data["registros"] = ["status" => "OK", "message" => "La venta se ha eliminado correctamente."];

            include( 'vistas/ajax/index.php');

            break;
        
        default:
            include( 'vistas/404/index.php');

    }
