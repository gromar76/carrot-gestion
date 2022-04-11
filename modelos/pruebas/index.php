<?php

    include_once 'funciones/conexion.php';

    function todosclientes(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM clientes ORDER BY nombre";
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros;
    }