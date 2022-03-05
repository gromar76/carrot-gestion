<?php

    include_once 'funciones/conexion.php';
    include_once 'modelos/pagos_compras/index.php';

    function obtenerTodosCompras(){

        $conexion = obtenerConexion();

        $consulta = 'SELECT compras.id, compras.fecha, compras.importe_total, nombre_empresa, compras.importe_pagado
                     FROM compras 
                     INNER JOIN proveedores prov 
                        ON prov.id = compras.id_proveedor
                     ORDER BY compras.fecha desc';
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);    
        return $registros;

    }

    function calcularTotal($productos){
        $total = 0;
        
        foreach ( $productos as $producto  ){
          $total += $producto->precioUnit * $producto->cantidad;
        }
  
        return $total;
      }
  
  
      function guardarDetalleCompra($idCompra, $productos, $conexion){
        foreach ( $productos as $producto  ){
          $consulta="INSERT INTO detalle_compras (id_compra, id_producto, cantidad, precio)
                     VALUES ( $idCompra, $producto->id, $producto->cantidad, $producto->precioUnit )";
  
          $resultado = $conexion->query($consulta);                  
        }
      }
  
      function eliminarDetalleCompra($idCompra, $conexion){
        $consulta="DELETE FROM detalle_compras
                   WHERE id_compra = $idCompra
                  ";
  
        $resultado = $conexion->query($consulta);
      } 


    function agregarCompra($data, $idUsuario){      
        $conexion = obtenerConexion();

        $proveedor               = $data->proveedor;
        $fecha                   = $data->fecha;      
        $observaciones           = $data->observaciones;        
        $productos               = $data->productos;
        $importe                 = calcularTotal($productos);   

        $primerPago              = $data->primerPago;
        $observacionesPrimerPago = $data->observacionesPrimerPago;
                
        $consulta="INSERT INTO compras (id_proveedor, importe_total, fecha, id_usuario, observaciones)
                    VALUES ( $proveedor, $importe, '$fecha', $idUsuario, '$observaciones' )";

        $resultado = $conexion->query($consulta);

        $idCompra = $conexion->insert_id;

        guardarDetalleCompra($idCompra, $productos, $conexion); 

        
        //VERIFICO SI HAY PRIMER PAGO Y SI ES ASI, LO GUARDO 
        $data = [];

        if ( $primerPago > 0 ) {

            $data["importe"]       = $primerPago;
            $data["fecha"]         = $fecha;
            $data["observaciones"] = $observacionesPrimerPago;

            agregarPagoCompra($data, $idCompra);
        }

        cerrarConexion($conexion);
    }

    function obtenerPorIdCompra($id){
        $conexion = obtenerConexion();
     
        $consulta = "SELECT compras.*, prov.nombre_empresa, prov.id id_proveedor
                     FROM compras 
                     INNER JOIN proveedores prov 
                     ON prov.id = compras.id_proveedor 
                     WHERE compras.id = $id";
  
        $resultado = $conexion->query($consulta);
        $compra = fetchAll( $resultado );
  
        $consulta = "SELECT prod.nombre, dc.id_producto id, dc.cantidad, dc.precio precioUnit
                     FROM detalle_compras dc
                     INNER JOIN productos prod
                     ON prod.id = dc.id_producto
                     WHERE id_compra = $id";
  
        $resultado = $conexion->query($consulta);
        $detalleCompra = fetchAll( $resultado );
  
        cerrarConexion($conexion);   
  
        return [ "compra" => $compra[0], "productos" => $detalleCompra ];
      }
  

    function modificarCompra($idCompra, $data, $usuario){
        $conexion = obtenerConexion();
   
        $proveedor     = $data->proveedor;
        $fecha       = $data->fecha;      
        $observaciones  = $data->observaciones;        
        $productos   = $data->productos;
        $importe     = calcularTotal($productos);      
             
        //Actualizo el encabezado de la compra 
        $consulta="UPDATE compras 
                      SET id_proveedor    = $proveedor,
                          importe_total   = $importe,
                          fecha           = '$fecha',
                          observaciones   = '$observaciones'
                      WHERE id = $idCompra
                   ";
  
        $resultado = $conexion->query($consulta);
  
        //Eliminar detalle de compra anterior
        eliminarDetalleCompra($idCompra, $conexion);
  
        //Guardar nuevo detalle compra
        guardarDetalleCompra($idCompra, $productos, $conexion);
  
        cerrarConexion($conexion);
      }  

    function eliminarCompra($idCompra){
        $conexion = obtenerConexion();
  
        //Eliminar detalle compra
        eliminarDetalleCompra($idCompra, $conexion);
  
        //Eliminar compra (Encabezado)
        $consulta="DELETE FROM compras
                   WHERE id = $idCompra
        ";
  
        $resultado = $conexion->query($consulta);
  
        cerrarConexion($conexion);
    }