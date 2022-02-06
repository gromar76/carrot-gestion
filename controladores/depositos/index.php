<?php

    //include("modelos/productos/index.php");
    //include("modelos/categorias_productos/index.php");

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
        return  isset( $_POST['nombre'] ) && strlen( trim($_POST['nombre']) ) >= 3  &&
                isset( $_POST['precio']);            
               
    }


    switch( $accion ){

        case "listado":
            //1- Obtener los datos de los productos (Pide al modelo de productos)       
            $data["registros"] = obtenerTodosDepositos();
            //var_dump($data["registros"][0]); exit();

            //2- Va a llamar a la vista pasandole los datos de los productos
            include( 'vistas/depositos/index.php');

            break;


        case "editar":
     
                //1. Verificar si viene con datos del formulario (payload)
                // aca hizo click en el boton GUARDAR ....ya venia editando

                if (isset($_POST["nombre"]))
                {
                    if (strlen(trim($_POST["nombre"])) > 3)
                    {
                        modificarProducto($_POST, $id);    
                        header('Location: index.php?m=depositos&a=listado&mensaje=Deposito modificado correctamente&tipoMensaje=success');
                    }   
                    else
                    {
                        //$data["mensaje"] = 'Debe completar todos los campos';
                        //$data["tipoMensaje"] = 'danger';
                        header('Location: index.php?m=depositos&a=listado&mensaje=Complete todos los campos obligatorios&tipoMensaje=danger');
                    }                 
                }
                else{
    
                    //2. obtener datos del producto a editar
                    // aca hizo click en el boton verde de editar
                    $data["registros"]  = obtenerPorIdDeposito($id);                    

                    //3. llamar a la vista pasandole los datos de ese cliente en particular           
                    include( 'vistas/depositos/index.php');
                }
    
                break;

            case "agregar":      
            
                   //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA
            if( isset( $_POST["nombre"] ) ){


                if ( validarDatos() ){     

                    agregarDeposito($_POST, $_SESSION['usuario']['id']);
                    header('Location: index.php?m=depositos&a=listado&mensaje=Deposito agregado correctamente&tipoMensaje=success');
                }else{

                    $data["mensaje"] = 'Completar todos los campos obligatorios';
                    $data["tipoMensaje"] = 'danger';

                    $data["registros"]["nombre"] = $_POST['nombre'] ?  $_POST['nombre'] : '';
                    $data["registros"]["descripcion"] = $_POST['descripcion'] ?  $_POST['descripcion'] : '';                  
                    $data["registros"]["precio"] = $_POST['precio'] ?  $_POST['precio'] : '';                    
                    $data["registros"]["id_categoria"] = $_POST['id_categoria'] ?  $_POST['id_categoria'] : '';                                       
 
                    include( 'vistas/depositos/index.php');
                }

            }else{                  
                //2. llamar a la vista pasandole los datos de ese cliente en particular           
                include( 'vistas/depositos/index.php');
            }

            break;        
        
        
        

        default:
            include( 'vistas/404/index.php');

    }


    