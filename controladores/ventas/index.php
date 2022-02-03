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
    
                    //2. obtener datos de la venta a editar
                    // aca hizo click en el boton verde de editar
                    $data["registros"] = obtenerPorId($id);                   
    
                    //3. llamar a la vista pasandole los datos de esa venta en particular           
                    include( 'vistas/ventas/index.php');
                }
    
                break;
        
            case "agregar":      
        
                //1. Verificar si viene con datos del formulario (payload)
                //APRETE BOTON GUARDAN DANDO DE ALTA
                if( isset( $_POST["cliente"] ) ){
    
                   if ( validarDatos() ){
                       echo "Guardar venta...";
                        /*agregar($_POST, $_SESSION['usuario']['id']);
    
                        header('Location: index.php?m=ventas&a=listado&mensaje=Venta agregada correctamente&tipoMensaje=success');*/
                   }else{
    
                        /*$data["mensaje"] = 'Completar todos los campos obligatorios';
                        $data["tipoMensaje"] = 'danger';
    
                        $data["registros"]["nombre"] = $_POST['nombre'] ?  $_POST['nombre'] : '';
                        $data["registros"]["apellido"] = $_POST['apellido'] ?  $_POST['apellido'] : '';

        
                        include( 'vistas/clientes/index.php');*/
                    }
    
                }else{        
                    
                    $data["clientes"] = obtenerTodosClientes(); //REFACTOR: cambiar nombre a obtenerTodosClientes
                    $data["productos"] = obtenerTodosProductos();

                    //2. llamar a la vista del editor de venta vacio    
                    include( 'vistas/ventas/index.php');
                }
    
                break;

        
        default:
            include( 'vistas/404/index.php');

    }
