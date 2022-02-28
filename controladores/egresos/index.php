<?php
   
    include("modelos/egresos/index.php");

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
        return  isset( $_POST['nombre'] ) && strlen( trim($_POST['nombre']) ) >= 3  &&
                isset( $_POST['precio']);            
               
    }


    switch( $accion ){

        case "listado":
            //1- Obtener los datos de los depositos (Pide al modelo de depositos)       
            $data["registros"] = obtenerTodosEgresos();

            //var_dump($data["registros"]); exit();

            //2- Va a llamar a la vista pasandole los datos de los depositos
            include( 'vistas/egresos/index.php');

            break;


        case "editar":
     
              

            case "agregar":      
            
                   //1. Verificar si viene con datos del formulario (payload)
            //APRETE BOTON GUARDAN DANDO DE ALTA
            if( isset( $_POST["nombre"] ) ){


                if ( validarDatos() ){     

                    agregarDeposito($_POST, $_SESSION['usuario']['id']);
                    header('Location: index.php?m=egresos&a=listado&mensaje=Deposito agregado correctamente&tipoMensaje=success');
                }else{

                    $data["mensaje"] = 'Completar todos los campos obligatorios';
                    $data["tipoMensaje"] = 'danger';

                    $data["registros"]["nombre"] = $_POST['nombre'] ?  $_POST['nombre'] : '';
                    $data["registros"]["descripcion"] = $_POST['descripcion'] ?  $_POST['descripcion'] : '';                                                                    
 
                    include( 'vistas/egresos/index.php');
                }

            }else{                  
                //2. llamar a la vista pasandole los datos de ese deposito en particular           
                include( 'vistas/egresos/index.php');
            }

            break;        
        
        
        

        default:
            include( 'vistas/404/index.php');

    }


    