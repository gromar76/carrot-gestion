<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosEgresos(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM egresos";
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
        return $registros;
    }


    function obtenerEgresoPorId($id){   

        $conexion = obtenerConexion();
    
        $consulta = 'SELECT id, nombre
                     FROM egresos
                     WHERE id_provincia=' . $id .' order by nombre';
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);
    
        return $registros;


    }
   

