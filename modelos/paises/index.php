<?php

include_once 'funciones/conexion.php';

function obtenerTodosPaises(){
    $conexion = obtenerConexion();

    $consulta = 'SELECT *
                 FROM paises 
                 order by nombre';
    
    $resultado = $conexion->query($consulta);
    $registros = fetchAll( $resultado );

    cerrarConexion($conexion);

    return $registros;
}
    