<?php
    
    // aca incluyo todas las llamadas a la base de datos
    include("modelos/pagos/index.php");
    include("modelos/ventas/index.php");

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

        case "listado":

            $data["registros"] = obtenerPagosPorIdVenta( $id );                       
            $data["venta"] = obtenerPorIdVentas( $id )["venta"];                       

            $data["usuario"]   =  $_SESSION['usuario'];          

            //2- Va a llamar a la vista pasandole los datos de los pagos
            include( 'vistas/pagos/index.php');

            break;
        
        case "editar":
    
            //1. Verificar si viene con datos del formulario (payload)
            // aca hizo click en el boton GUARDAR ....ya vania editando
            
            $idVenta = $_GET["idVenta"];  
            if( isset( $_POST["fecha"] )) 
            {              

                modificarPago($_POST, $id, $idVenta);
                header("Location: index.php?m=pagos&id=$idVenta&a=listado&mensaje=Pago modificado correctamente&tipoMensaje=success");            
            }
            else
            {              
                $data["venta"] = obtenerPorIdVentas( $idVenta )["venta"];       

                //2. obtener datos del pago a editar
                // aca hizo click en el boton verde de editar
                $data["registros"] = obtenerPorIdPago($id);
                //3. llamar a la vista pasandole los datos de ese pago en particular           
                include( 'vistas/pagos/index.php');   
                                
            }
            break;

        case "ver":
        
            $idVenta = $_GET["idVenta"];  
            
            // aqui la direccion es m=pagos&a=ver
            //1. obtener datos del pago a ver
            $data["registros"] = obtenerPorIdPago($id);
            $data["venta"] = obtenerPorIdVentas( $idVenta )["venta"];       

            //2. llamar a la vista pasandole los datos de ese pago en particular           
            include( 'vistas/pagos/index.php');

            break;
    
        case "eliminar":  
            $idVenta = $_GET["idVenta"];    

            eliminarPago($id, $idVenta);

            header("Location: index.php?m=pagos&a=listado&id=$idVenta&mensaje=Pago eliminado correctamente&tipoMensaje=success");

            break;

        case "agregar":      
          
        
            //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA
            $idVenta = $_GET["idVenta"];   

            if( isset( $_POST["fecha"] ) ){      

                agregarPago( $_POST, $idVenta );

                header("Location: index.php?m=pagos&id=$idVenta&a=listado&mensaje=Pago agregado correctamente&tipoMensaje=success");            
            }else{           
                $data["venta"] = obtenerPorIdVentas($idVenta )["venta"];  

                //2. llamar a la vista pasandole los datos de ese cliente en particular           
                include( 'vistas/pagos/index.php');
            }

            break;
    
        
        default:
            include( 'vistas/404/index.php');
        
    }
