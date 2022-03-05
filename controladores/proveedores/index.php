<?php
    
    // aca incluyo todas las llamadas a la base de datos
    include("modelos/proveedores/index.php");
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
        return  isset( $_POST['nombre_empresa'] ) && strlen( trim($_POST['nombre_empresa']) ) >= 3;
               
    }

    switch( $accion ){

        case "listado":
            //1- Obtener los datos de los clientes (Pide al modelo de clientes)

            
           
           

            // opcion por default, arranco por aca clientes      
            $data["registros"] = obtenerTodosProveedores();           
            $data["usuarios"]  = obtenerTodosUsuarios();
            $data["usuario"]   =  $_SESSION['usuario'];
            //var_dump($data["registros"][0]);

            //2- Va a llamar a la vista pasandole los datos de los clientes
            include( 'vistas/proveedores/index.php');

            break;
        
        case "listadoAjax":
            //1- Obtener los datos de los clientes (Pide al modelo de clientes)

            // opcion por default, arranco por aca clientes      
            $data["registros"] = obtenerTodosProveedores();           

            //2- Va a llamar a la vista pasandole los datos de los clientes
            include( 'vistas/ajax/index.php');

            break;
        
        case "dameNombreAjax":
            $data["registros"] = dameNombreProveedor( $id ); 

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
                        header('Location: index.php?m=proveedores&a=listado&mensaje=Proveedor modificado correctamente&tipoMensaje=success');
                    }                    
                    else
                    {
                        header('Location: index.php?m=proveedores&a=listado&mensaje=Complete los campos obligatorios&tipoMensaje=danger');
                        
                    }
            }
            else
            {
                    //2. obtener datos del cliente a editar
                    // aca hizo click en el boton verde de editar
                    $data["registros"] = obtenerPorIdProveedores($id);
                    //3. llamar a la vista pasandole los datos de ese cliente en particular           
                    include( 'vistas/proveedor/index.php');               
            }
            break;
    
        case "ver":
            
            // aqui la direccion es m=clientes&a=ver
            //1. obtener datos del cliente a editar
            $data["registros"] = obtenerPorIdProveedores($id);

            //2. llamar a la vista pasandole los datos de ese cliente en particular           
            include( 'vistas/proveedor/index.php');

            break;


        case "agregar":      
            
            //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA
            if( isset( $_POST["nombre"] ) ){        

                $proveedorExistente = $_POST['whatsapp'] ? esProveedorExistente( trim($_POST['nombre_empresa']) ) : false;

                if ( validarDatos() && !$proveedorExistente ){
                    agregarProveedores($_POST, $_SESSION['usuario']['id']);

                    header('Location: index.php?m=proveedores&a=listado&mensaje=Proveedor agregado correctamente&tipoMensaje=success');
                }else{

                    if ( !esProveedorExistente( trim($_POST['nombre_empresa']) ) ){
                        $data["mensaje"] = 'Completar todos los campos obligatorios';
                    }else{
                        $data["mensaje"] = 'El proveedor ya existe';
                    }

                    $data["tipoMensaje"] = 'danger';

                    $data["registros"]["nombre_empresa"] = $_POST['nombre_empresa'] ?  $_POST['nombre_empresa'] : '';                         
                    $data["registros"]["observaciones"] = $_POST['observaciones'] ?  $_POST['observaciones'] : '';

                    include( 'vistas/proveedor/index.php');
                }
                
               

            }else{                  
                //2. llamar a la vista pasandole los datos de ese cliente en particular           
                include( 'vistas/proveedor/index.php');
            }

            break;
        
        case "eliminar":  
            eliminarProveedores($id);
            
            header('Location: index.php?m=proveedor&a=listado&mensaje=Proveedor eliminado correctamente&tipoMensaje=success');

            break;
        
        default:
            include( 'vistas/404/index.php');

    }

    