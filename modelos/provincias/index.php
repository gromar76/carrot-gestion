<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosProvincias(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM provincias ORDER BY nombre";
        
        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;

        cerrarConexion($conexion);

        return $registros;
    }

    function obtenerPorIdProvincias($id){

        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM provincias where pais_id=$id ORDER BY nombre";        

        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;

        cerrarConexion($conexion);

        return $registros;
    }

    function agregarProvincia($data){
        $conexion = obtenerConexion();
        $consulta = "INSERT INTO provincias (id, nombre, baja) ";
                
        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;

        cerrarConexion($conexion);

        return $registros;
    }

    function modificarCatProd($data, $id){
        
    }

    function eliminarCatProd($id){

    }