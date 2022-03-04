<?php

    include_once 'funciones/conexion.php';
    //include_once 'modelos/pagos_compras/index.php';

    function obtenerTodosCompras(){

        $conexion = obtenerConexion();

        $consulta = 'SELECT compras.id, compras.fecha, compras.importe_total, CONCAT(prov.nombre_empresa, "") nombre_empresa, compras.importe_pagado
                     FROM compras 
                     INNER JOIN proveedores prov 
                        ON prov.id = compras.id_proveedor
                     ORDER BY compras.fecha desc';
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);    
        return $registros;

    }
