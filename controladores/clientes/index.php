<?php
    
    // aca incluyo todas las llamadas a la base de datos
    include("modelos/clientes/index.php");
    include("modelos/usuarios/index.php");

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

    function validarDatos(){

        // estaba dando de alta y valido que ingrese por lo menos algun nombre minimo 3 caract
        // y que provincia y localidad tenga algun valor valido, default viene con -1
        return  isset( $_POST['nombre'] ) && strlen( trim($_POST['nombre']) ) >= 3  &&
                isset( $_POST['pais'] ) &&
                isset( $_POST['provincia'] ) && $_POST['provincia'] != '-1' &&
                isset( $_POST['id_localidad'] ) && $_POST['id_localidad'] != '-1';
               
    }

    switch( $accion ){

        case "listado":            

            //1- Obtener los datos de los clientes (Pide al modelo de clientes)

            $data["clientesDe"] =  isset($_GET['u'] ) ? $_GET['u'] : $_SESSION['usuario']['id'];
            $data["actividad"]  =  isset($_GET['actividad'] ) ? $_GET['actividad'] : 'ambos';
           

            // opcion por default, arranco por aca clientes      
            $data["registros"] = obtenerTodosClientes($data["clientesDe"], $data["actividad"] );           
            $data["usuarios"]  = obtenerTodosUsuarios();
            $data["usuario"]   =  $_SESSION['usuario'];
            //var_dump($data["registros"][0]);

            //2- Va a llamar a la vista pasandole los datos de los clientes
            include( 'vistas/clientes/index.php');

            break;
        
        case "listadoAjax":
            //1- Obtener los datos de los clientes (Pide al modelo de clientes)

            $data["clientesDe"] =  -1; //isset($_GET['u'] ) ? $_GET['u'] : $_SESSION['usuario']['id'];
            $data["actividad"]  =  isset($_GET['actividad'] ) ? $_GET['actividad'] : 'todas';
            

            // opcion por default, arranco por aca clientes      
            $data["registros"] = obtenerTodosClientes($data["clientesDe"], $data["actividad"] );           

            //2- Va a llamar a la vista pasandole los datos de los clientes
            include( 'vistas/ajax/index.php');

            break;
        
        case "dameNombreAjax":
            $data["registros"] = dameNombreCliente( $id ); 

            include( 'vistas/ajax/index.php');

            break;
           

        case "editar":
     
            //1. Verificar si viene con datos del formulario (payload)
            // aca hizo click en el boton GUARDAR ....ya vania editando
            if( isset( $_POST["nombre"] )) 
            {   
                    if (strlen(trim($_POST["nombre"]))>3)
                    {           
                        modificarClientes($_POST, $id);                        
                        header('Location: index.php?m=clientes&a=listado&mensaje=Cliente modificado correctamente&tipoMensaje=success');
                    }                    
                    else
                    {
                        header('Location: index.php?m=clientes&a=listado&mensaje=Complete los campos obligatorios&tipoMensaje=danger');
                        
                    }
            }
            else
            {
                    //2. obtener datos del cliente a editar
                    // aca hizo click en el boton verde de editar
                    $data["registros"] = obtenerPorIdClientes($id);
                    //3. llamar a la vista pasandole los datos de ese cliente en particular           
                    include( 'vistas/clientes/index.php');               
            }
            break;
    
        case "ver":
            
            // aqui la direccion es m=clientes&a=ver
            //1. obtener datos del cliente a editar
            $data["registros"] = obtenerPorIdClientes($id);

            //2. llamar a la vista pasandole los datos de ese cliente en particular           
            include( 'vistas/clientes/index.php');

            break;


        case "agregar":      
            
            //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA
            if( isset( $_POST["nombre"] ) ){        

                $clienteExistente = $_POST['whatsapp'] ? esClienteExistente( trim($_POST['whatsapp']) ) : false;

                if ( validarDatos() && !$clienteExistente ){
                    agregarClientes($_POST, $_SESSION['usuario']['id']);

                    header('Location: index.php?m=clientes&a=listado&mensaje=Cliente agregado correctamente&tipoMensaje=success');
                }else{

                    if ( !esClienteExistente( trim($_POST['whatsapp']) ) ){
                        $data["mensaje"] = 'Completar todos los campos obligatorios';
                    }else{
                        $data["mensaje"] = 'El cliente ya existe';
                    }

                    $data["tipoMensaje"] = 'danger';

                    $data["registros"]["nombre"]          = isset($_POST['nombre']) ?  $_POST['nombre'] : '';
                    $data["registros"]["apellido"]        = isset($_POST['apellido']) ?  $_POST['apellido'] : '';
                    $data["registros"]["dni"]             = isset($_POST['dni']) ?  $_POST['dni'] : '';
                    $data["registros"]["whatsapp"]        = isset($_POST['whatsapp']) ?  $_POST['whatsapp'] : '';
                    $data["registros"]["telefono2"]       = isset($_POST['telefono2']) ?  $_POST['telefono2'] : '';
                    $data["registros"]["email"]           = isset($_POST['email']) ?  $_POST['email'] : '';
                    $data["registros"]["es_cliente_de"]   = isset($_POST['es_cliente_de']) ?  $_POST['es_cliente_de'] : '';
                    $data["registros"]["es_distribuidor"] = isset($_POST['es_distribuidor']) ?  $_POST['es_distribuidor'] : '';
                    $data["registros"]["domicilio"]       = isset($_POST['domicilio']) ?  $_POST['domicilio'] : '';
                    $data["registros"]["cpostal"]         = isset($_POST['cpostal'] )?  $_POST['cpostal'] : '';
                    $data["registros"]["id_pais"]         = isset($_POST['pais'] )?  $_POST['pais'] : '';
                    $data["registros"]["id_provincia"]    = isset($_POST['provincia'] )?  $_POST['provincia'] : '';
                    $data["registros"]["id_localidad"]    = isset($_POST['id_localidad']) ?  $_POST['id_localidad'] : '';
                    $data["registros"]["paginaweb"]       = isset($_POST['paginaweb'] )?  $_POST['paginaweb'] : '';
                    $data["registros"]["instagram"]       = isset($_POST['instagram']) ?  $_POST['instagram'] : '';                    
                    $data["registros"]["facebook"]        = isset($_POST['facebook'] )?  $_POST['facebook'] : '';                    
                    $data["registros"]["observaciones"]   = isset($_POST['observaciones']) ?  $_POST['observaciones'] : '';

                    include( 'vistas/clientes/index.php');
                }
                
               

            }else{                  
                //2. llamar a la vista pasandole los datos de ese cliente en particular           
                include( 'vistas/clientes/index.php');
            }

            break;
        
        case "eliminar":  
            eliminarClientes($id);
            
            header('Location: index.php?m=clientes&a=listado&mensaje=Cliente eliminado correctamente&tipoMensaje=success');

            break;
        
        default:
            include( 'vistas/404/index.php');

    }

    