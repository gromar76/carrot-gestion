<?php

include_once 'funciones/conexion.php';

function obtenerTodosUsuarios(){
    $conexion = obtenerConexion();

    $consulta = 'SELECT *
                 FROM usuarios 
                 ORDER BY nombre';
    
    $resultado = $conexion->query($consulta);
     $registros = fetchAll( $resultado );

    cerrarConexion($conexion);

    return $registros;
}
    