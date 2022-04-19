<?php

    //include_once 'funciones/conexion-mag.php';
    include_once 'funciones/conexion.php';
    
    function dameTodosCompradoresMag(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM compradores ORDER BY nombre";
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        cerrarConexion($conexion);
        
        return $registros;
    }



    function dameTodosClientes(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM clientes ORDER BY nombre";
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        cerrarConexion($conexion);
        
        return $registros;
    }