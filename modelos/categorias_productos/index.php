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
        $consulta = "INSERT INTO categorias_productos (id, nombre, baja) ";
                
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros;
    }

    function modificarCatProd($data, $id){
        
    }

    function eliminarCatProd($id){

    }