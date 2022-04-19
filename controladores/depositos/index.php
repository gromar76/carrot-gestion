<?php
   
    include("modelos/depositos/index.php");

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
        return  true; /* isset( $_POST['nombre'] ) && strlen( trim($_POST['nombre']) ) >= 3  &&
                isset( $_POST['precio']);     */        
               
    }


    switch( $accion ){

        case "listado":
            //1- Obtener los datos de los depositos (Pide al modelo de depositos)       
            $data["registros"] = obtenerTodosDepositos();

            //var_dump($data["registros"]); exit();

            //2- Va a llamar a la vista pasandole los datos de los depositos
            include( 'vistas/depositos/index.php');

            break;


        case "depositosDestinoAjax":
        
                $data["registros"] = obtenerDepositosDestino( $_GET["id_origen"] );

                include( 'vistas/ajax/index.php');

            break;

        case "usuariosDelDepositoAjax":
    
            $data["registros"] = obtenerUsuariosDelDepositoAjax( $_GET["id_deposito"] );

            include( 'vistas/ajax/index.php');

        break;

        case "editar":
            //1. Verificar si viene con datos del formulario (payload)
            // aca hizo click en el boton GUARDAR ....ya venia editando
            if( isset( $_POST["nombre"] ) && trim( $_POST["nombre"] )!='' ){                   
                
                modificarDeposito($_POST, $id);                    
                header('Location: index.php?m=depositos&a=listado&mensaje=Deposito modificada correctamente&tipoMensaje=success');                }
            else{

                //2. obtener datos del producto a editar
                // aca hizo click en el boton verde de editar
                $data["registros"]  = obtenerDepositoPorId($id);   

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

                    include( 'vistas/depositos/index.php');
                }

            }else{                  
                //2. llamar a la vista pasandole los datos de ese deposito en particular           
                include( 'vistas/depositos/index.php');
            }

            break;                 
        
        

        default:
            include( 'vistas/404/index.php');

    }


    