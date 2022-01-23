<?php
    
    // aca incluyo todas las llamadas a la base de datos
    include("modelos/clientes/index.php");

    // seteo de variables por default cuando entro a la pagina
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
            $data["registros"] = obtenerTodos();
            //var_dump($data["registros"][0]);

            //2- Va a llamar a la vista pasandole los datos de los clientes
            include( 'vistas/clientes/index.php');

            break;

        case "editar":
     
            //1. Verificar si viene con datos del formulario (payload)
            // aca hizo click en el boton GUARDAR ....ya vania editando
            if( isset( $_POST["nombre"] ) ){
                modificar($_POST, $id);

                header('Location: index.php?m=clientes&a=listado&mensaje=Cliente modificado correctamente&tipoMensaje=success');
            }
            else{

                //2. obtener datos del cliente a editar
                // aca hizo click en el boton verde de editar
                $data["registros"] = obtenerPorId($id);

                //3. llamar a la vista pasandole los datos de ese cliente en particular           
                include( 'vistas/clientes/index.php');
            }

            break;

    
        case "ver":
            
            // aqui la direccion es m=clientes&a=ver
            //1. obtener datos del cliente a editar
            $data["registros"] = obtenerPorId($id);

            //2. llamar a la vista pasandole los datos de ese cliente en particular           
            include( 'vistas/clientes/index.php');

            break;


        case "agregar":      
            
            //1. Verificar si viene con datos del formulario (payload)
            if( isset( $_POST["nombre"] ) ){
                agregar($_POST);

                header('Location: index.php?m=clientes&a=listado&mensaje=Cliente agregado correctamente&tipoMensaje=success');
            }else{                  
                //2. llamar a la vista pasandole los datos de ese cliente en particular           
                include( 'vistas/clientes/index.php');
            }

            break;
        
        case "eliminar":  
            eliminar($id);
            
            header('Location: index.php?m=clientes&a=listado&mensaje=Cliente eliminado correctamente&tipoMensaje=success');

            break;
        
        default:
            include( 'vistas/404/index.php');

    }

    