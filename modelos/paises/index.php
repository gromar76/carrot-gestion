<?php

include_once 'funciones/conexion.php';

function obtenerTodos(){
    $conexion = obtenerConexion();

    $consulta = 'SELECT *
    FROM paises order by nombre';
    
    $resultado = $conexion->query($consulta);
    $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;

    cerrarConexion($conexion);

    return $registros;
}
    