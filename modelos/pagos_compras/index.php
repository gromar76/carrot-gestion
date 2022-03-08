<?php

include_once 'funciones/conexion.php';

 function obtenerPagosPorIdCompra($idCompra){
    $conexion = obtenerConexion();

    $consulta = "SELECT *
                 FROM pagos_compras
                 WHERE id_compra = $idCompra";
    
    $resultado = $conexion->query($consulta);
    $registros = fetchAll( $resultado );

    cerrarConexion($conexion);

    return $registros;
}
/* 

function obtenerPorIdVenta($idCompra){
    $conexion = obtenerConexion();

    $consulta = "SELECT *
                 FROM pagos_compras
                 WHERE id = $idCompra";
    
    $resultado = $conexion->query($consulta);
    $registros = fetchAll( $resultado );

    cerrarConexion($conexion);

    return $registros[0]; 
}

function obtenerImporteCompra($idCompra, $conexion){
    $consulta = "SELECT importe_pagado
    FROM compras
    WHERE id = $idCompra";

    $resultado = $conexion->query($consulta);

    $registros = fetchAll( $resultado );

    $importe =  $registros[0]["importe_pagado"];

    return $importe;
}*/

function actualizarImportePagoCompra($idCompra, $importe, $conexion){
    //ACTUALIZO PAGADO
    $consulta = "UPDATE compras
    SET importe_pagado = importe_pagado + $importe
    WHERE id = $idCompra" ;  

    $resultado = $conexion->query($consulta);

}

/*function eliminarPago($idPago,  $idCompra){
    $conexion = obtenerConexion();

    //OBTENGO EL IMPORTE DEL PAGO A BORRAR
    $importe = obtenerImportePago($idPago, $conexion);

    $consulta = "DELETE 
                 FROM pagos_compras
                 WHERE id = $idPago";
    
    $resultado = $conexion->query($consulta);

    
    //ACTUALIZO PAGADO
    actualizarImportePago($idVenta, -$importe, $conexion);
 
    cerrarConexion($conexion);
}

function modificarPagoCompras($data, $idPago, $idCompra){
    $conexion = obtenerConexion();

    //OBTENGO EL IMPORTE DEL PAGO A BORRAR
    $importeOriginal = obtenerImportePago($idPago, $conexion);

    $importe       = $data["importe"]; 
    $fecha         = $data["fecha"];
    $observaciones = $data["observaciones"];

    $consulta = "UPDATE pagos
                    SET importe       = $importe, 
                        fecha         = '$fecha',
                        observaciones = '$observaciones'
                 WHERE  id = $idPago";
    
    $resultado = $conexion->query($consulta);

    //ACTUALIZO PAGADO
    actualizarImportePago($idCompra, $importe - $importeOriginal, $conexion);

    cerrarConexion($conexion);
} */

function agregarPagoCompra($data, $idCompra){
    $conexion = obtenerConexion();

    $importe       = $data["importe"];
    $fecha         = $data["fecha"];
    $observaciones = $data["observaciones"];

    $consulta = "INSERT INTO pagos_compras(id_compra, importe, fecha, observaciones)
                       VALUES ($idCompra, $importe, '$fecha', '$observaciones')";  
    
    $resultado = $conexion->query($consulta);


    actualizarImportePagoCompra($idCompra, $importe, $conexion);

    cerrarConexion($conexion);
}