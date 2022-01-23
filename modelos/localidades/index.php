<?php

    include_once 'funciones/conexion.php';

    function obtenerTodos(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM localidades ORDER BY nombre";
        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;
        return $registros;
    }


    function obtenerPorId($id){
   

        $conexion = obtenerConexion();
    
        $consulta = 'SELECT id, nombre
                     FROM localidades
                     WHERE id_provincia=' . $id .' order by nombre';
        
        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;
    
        cerrarConexion($conexion);
    
        return $registros;


    }
   

    function agregar($data){

    }

    function modificar($data, $id){
        
    }

    function eliminar($id){

    }