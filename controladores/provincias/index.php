<?php

    include("modelos/provincias/index.php");
    include("modelos/paises/index.php");
    
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
        // y que categoria tenga algun valor valido, default viene con -1
        return  isset( $_POST['nombre'] ) && strlen( trim($_POST['nombre']) ) >= 3;
    }

    switch( $accion ){

        case "listadoAjax":
            //1- Obtener los datos de los productos (Pide al modelo de productos)       
            
            $data["registros"] = obtenerPorIdProvinciasDeUnPais($_GET["id"]);

            //2- Va a llamar a la vista pasandole los datos de los productos
            include( 'vistas/provincias/index.php');

            break;

        case "listado":
            //1- Obtener los datos de los productos (Pide al modelo de productos)       
            $data["registros"] = obtenerTodosProvinciasTabla();
            //var_dump($data["registros"][0]); exit();

            //2- Va a llamar a la vista pasandole los datos de los productos
            include( 'vistas/provincias/index.php');

            break;


        case "editar":
     
                //1. Verificar si viene con datos del formulario (payload)
                // aca hizo click en el boton GUARDAR ....ya venia editando

                if (isset($_POST["nombre"]))
                {
                    if (strlen(trim($_POST["nombre"])) > 3)
                    {
                       
                        modificarProvincia($_POST, $id);    
                        header('Location: index.php?m=provincias&a=listado&mensaje=Provincia modificado correctamente&tipoMensaje=success');
                    }   
                    else
                    {
                        //$data["mensaje"] = 'Debe completar todos los campos';
                        //$data["tipoMensaje"] = 'danger';
                        
                        header('Location: index.php?m=provincias&a=listado&mensaje=Complete todos los campos obligatorios&tipoMensaje=danger');
                    }                 
                }
                else{
    
                    //2. obtener datos del producto a editar
                    // aca hizo click en el boton verde de editar                     

                    $data["registros"]  = obtenerPorIdProvincia($id);

                    //var_dump( $data["registros"] );exit();

                   //echo $data['registros']['nombre'];exit();            

                    $data["paises"]     = obtenerTodosPaises();                    
                    

                    //3. llamar a la vista pasandole los datos de esa provincia en particular           
                    include( 'vistas/provincias/index.php');
                }
    
                break;

            case "agregar":      
            
            //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA
            if( isset( $_POST["nombre"] ) ){

                if ( validarDatos() ){
                    agregarProvincia($_POST, $_SESSION['usuario']['id']);
                    header('Location: index.php?m=provincias&a=listado&mensaje=Provincia agregada correctamente&tipoMensaje=success');
                }else{

                    $data["mensaje"] = 'Completar todos los campos obligatorios';
                    $data["tipoMensaje"] = 'danger';

                    $data["registros"]["nombre"] = $_POST['nombre'] ?  $_POST['nombre'] : '';                    
                    $data["registros"]["id_pais"] = $_POST['id_pais'] ?  $_POST['id_pais'] : '';                                       
 
                    include( 'vistas/provincias/index.php');
                }

            }else{                                 
                include( 'vistas/provincias/index.php');
            }

            break;
        
        
        default:
            include( 'vistas/404/index.php');

    }


    