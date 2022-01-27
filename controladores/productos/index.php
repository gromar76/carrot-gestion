<?php

    include("modelos/productos/index.php");
    include("modelos/categorias_productos/index.php");

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

    switch( $accion ){

        case "listado":
            //1- Obtener los datos de los productos (Pide al modelo de productos)       
            $data["registros"] = obtenerTodos();
            //var_dump($data["registros"][0]);

            //2- Va a llamar a la vista pasandole los datos de los productos
            include( 'vistas/productos/index.php');

            break;


        case "editar":
     
                //1. Verificar si viene con datos del formulario (payload)
                // aca hizo click en el boton GUARDAR ....ya venia editando

                if (isset($_POST["nombre"]))
                {
                    if ($_POST["nombre"]!='')
                    {
                        modificar($_POST, $id);    
                        header('Location: index.php?m=productos&a=listado&mensaje=Producto modificado correctamente&tipoMensaje=success');
                    }   
                    else
                    {
                        //$data["mensaje"] = 'Debe completar todos los campos';
                        //$data["tipoMensaje"] = 'danger';
                        header('Location: index.php?m=productos&a=listado&mensaje=Complete todos los campos obligatorios&tipoMensaje=danger');
                    }                 
                }
                else{
    
                    //2. obtener datos del producto a editar
                    // aca hizo click en el boton verde de editar
                    $data["registros"]  = obtenerPorId($id);
                    $data["categorias"] = obtenerTodosCatProd();

                    //3. llamar a la vista pasandole los datos de ese cliente en particular           
                    include( 'vistas/productos/index.php');
                }
    
                break;

            case "agregar":      
            
                    //1. Verificar si viene con datos del formulario (payload)                   

                    if( isset( $_POST["nombre"] ) && strlen(trim($_POST["nombre"]))>0){
                        agregar($_POST);
                        header('Location: index.php?m=productos&a=listado&mensaje=Producto agregado correctamente&tipoMensaje=success');
                    }else{                  

                        echo "acaaaa";
                        exit();

                        $data["categorias"] = obtenerTodosCatProd();

                        //2. llamar a la vista         
                        include( 'vistas/productos/index.php');
                    }
        
                    break;
        
        default:
            include( 'vistas/404/index.php');

    }


    