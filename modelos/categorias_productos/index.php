<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosCatProd(){
        $conexion = obtenerConexion();
        $consulta = "SELECT id, nombre FROM categorias_productos ORDER BY nombre";
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros;
    }

    function obtenerPorIdCatProd($id){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM categorias_productos where id='$id' ORDER BY nombre";        
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros[0];
    }

    function agregarCatProd($data){
        $conexion = obtenerConexion();

        $nombre      = $data["nombre"];
                
        $consulta = "INSERT INTO categorias_productos (nombre) VALUES ('$nombre')";
        $resultado = $conexion->query($consulta);

        cerrarConexion($conexion);

    }

    function modificarCatProd($data, $id){

        $conexion = obtenerConexion();

        $nombre      = $data["nombre"];
            
        $consulta="UPDATE categorias_productos
                     SET nombre = '$nombre'                                      
                   WHERE id = $id";

        //echo $consulta;exit();

        $resultado = $conexion->query($consulta);        
        cerrarConexion($conexion);
    }

    function eliminarCatProd($id){

    }