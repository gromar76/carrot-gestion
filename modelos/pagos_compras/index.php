<?php

include_once 'funciones/conexion.php';

/* function obtenerPagosPorIdVenta($id){
    $conexion = obtenerConexion();

    $consulta = "SELECT *
                 FROM pagos
                 WHERE id_venta = $id";
    
    $resultado = $conexion->query($consulta);
    $registros = fetchAll( $resultado );

    cerrarConexion($conexion);

    return $registros;
}
    

function obtenerPorIdPago($id){
    $conexion = obtenerConexion();

    $consulta = "SELECT *
                 FROM pagos
                 WHERE id = $id";
    
    $resultado = $conexion->query($consulta);
    $registros = fetchAll( $resultado );

    cerrarConexion($conexion);

    return $registros[0]; 
}

function obtenerImportePago($idPago, $conexion){
    $consulta = "SELECT importe 
    FROM pagos
    WHERE id = $idPago";

    $resultado = $conexion->query($consulta);

    $registros = fetchAll( $resultado );

    $importe =  $registros[0]["importe"];

    return $importe;
}*/

function actualizarImportePagoCompra($idCompra, $importe, $conexion){
    //ACTUALIZO PAGADO
    $consulta = "UPDATE compras
    SET importe_pagado = importe_pagado + $importe
    WHERE id = $idCompra" ;  

    $resultado = $conexion->query($consulta);

}

/*function eliminarPago($idPago,  $idVenta){
    $conexion = obtenerConexion();

    //OBTENGO EL IMPORTE DEL PAGO A BORRAR
    $importe = obtenerImportePago($idPago, $conexion);

    $consulta = "DELETE 
                 FROM pagos
                 WHERE id = $idPago";
    
    $resultado = $conexion->query($consulta);

    
    //ACTUALIZO PAGADO
    actualizarImportePago($idVenta, -$importe, $conexion);
 
    cerrarConexion($conexion);
}

function modificarPago($data, $idPago, $idVenta){
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
    actualizarImportePago($idVenta, $importe - $importeOriginal, $conexion);

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