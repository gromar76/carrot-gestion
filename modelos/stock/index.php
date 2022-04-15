<?php

    include_once 'funciones/conexion.php';

    function dameStockDeposito($id){
        $conexion = obtenerConexion();
        $consulta = "SELECT pr.id, pr.nombre, st.cantidad
                     FROM stock st
                     INNER JOIN productos pr
                     ON pr.id = st.id_producto
                     WHERE st.id_deposito = $id 
                       AND st.cantidad > 0";     
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        cerrarConexion($conexion);        

        return $registros;
    }