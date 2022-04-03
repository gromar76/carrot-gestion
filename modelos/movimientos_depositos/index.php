<?php

    include_once 'funciones/conexion.php';
 
    function obtenerTodosMovimientosDepositos(){

        $conexion = obtenerConexion();

        $consulta = 'SELECT md.id, md.fecha, usr.nombre usuario, (SELECT GROUP_CONCAT( CONCAT( " ", dmd.cantidad, " ", prod.nombre) )  ) detalle ,(SELECT dep.nombre FROM depositos dep WHERE dep.id = md.id_origen) origen, 
                        (SELECT dep.nombre FROM depositos dep WHERE dep.id = md.id_destino) destino,
                        (SELECT COUNT(confirmado) FROM detalle_movimientos_depositos WHERE id_movimiento = md.id AND confirmado = 0) por_confirmar
                      FROM detalle_movimientos_depositos dmd
                      INNER JOIN productos prod
                      ON prod.id = dmd.id_producto
                          INNER JOIN movimientos_depositos md
                          ON md.id = dmd.id_movimiento
                          INNER JOIN usuarios usr
                          ON usr.id = md.id_usuario
                      GROUP BY md.id';
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);    
        return $registros;

    }

      
  
      function guardarDetalleMovimientoDeposito($idMovimientoDeposito, $detalle,  $origen, $destino, $conexion){
        foreach ( $detalle as $producto  ){
          $consulta="INSERT INTO detalle_movimientos_depositos (id_movimiento, id_producto, cantidad)
                     VALUES ( $idMovimientoDeposito, $producto->id, $producto->cantidad )";
  
          $conexion->query($consulta);
        }
      }

      function confirmarProductoMovimientoDeposito($idProducto, $idMovimientoDeposito){
        //CONFIRMACION...

        //Resto de origen
        $consulta = "INSERT INTO stock(id_producto, id_deposito, cantidad)
        VALUES($producto->id, $origen, $producto->cantidad)
        ON DUPLICATE KEY UPDATE
        cantidad = cantidad - $producto->cantidad";
        
        $conexion->query($consulta);

        //Sumo en destino
        $consulta = "INSERT INTO stock(id_producto, id_deposito, cantidad)
                      VALUES($producto->id, $destino, $producto->cantidad)
                      ON DUPLICATE KEY UPDATE
                      cantidad = cantidad + $producto->cantidad";

        $conexion->query($consulta);
      }
  
      function eliminarDetalleCompra($idCompra, $conexion){

        //Reseteo stock

        //1- Obtener el id del deposito de la compra
        $consulta = "SELECT id_deposito
                     FROM compras
                     WHERE id = $idCompra";

        $resultado = $conexion->query($consulta);

        $idDeposito = (fetchAll( $resultado ))[0]["id_deposito"];

        //2- Obtener el detalle de la compra
        $consulta = "SELECT id_producto, cantidad
                     FROM detalle_compras
                     WHERE id_compra = $idCompra";
 
        $resultado = $conexion->query($consulta);

        $detalleCompra = fetchAll( $resultado );

        foreach( $detalleCompra as $lineaDetalle ){
          $consulta = 'UPDATE stock
                       SET cantidad = cantidad - ' . $lineaDetalle["cantidad"] . 
                       ' WHERE id_producto = ' . $lineaDetalle["id_producto"] . 
                       ' AND id_deposito = ' . $idDeposito;
          
          $conexion->query($consulta);
        }
        
        $consulta="DELETE FROM detalle_compras
                   WHERE id_compra = $idCompra
                  ";
  
        $resultado = $conexion->query($consulta);
      } 


    function agregarMovimientoDeposito($data, $idUsuario){      
        $conexion = obtenerConexion();

        $fecha         = $data->fecha;      
        $origen        = $data->origen;
        $destino       = $data->destino;
        $observaciones = $data->observaciones;        
        $detalle       = $data->detalle;
                
        $consulta="INSERT INTO movimientos_depositos(fecha, id_origen, id_destino, observaciones, id_usuario)
                   VALUES ( '$fecha', $origen, $destino, '$observaciones', $idUsuario )";


        $resultado = $conexion->query($consulta);

        $idMovimientoDeposito = $conexion->insert_id;

        guardarDetalleMovimientoDeposito($idMovimientoDeposito, $detalle,  $origen, $destino, $conexion); 

        cerrarConexion($conexion);
    }

/*    function obtenerPorIdCompra($id){
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
        $fecha         = $data->fecha;      
        $observaciones = $data->observaciones;        
        $productos     = $data->productos;
        $importe       = calcularTotal($productos);  
        $deposito      = $data->deposito;


        //Eliminar detalle de compra anterior
        eliminarDetalleCompra($idCompra, $conexion);
  
        //Actualizo el encabezado de la compra 
        $consulta="UPDATE compras 
                      SET id_proveedor    = $proveedor,
                          importe_total   = $importe,
                          fecha           = '$fecha',
                          observaciones   = '$observaciones',
                          id_deposito     = $deposito
                      WHERE id = $idCompra
                   ";
  
        $resultado = $conexion->query($consulta);
  
  
        //Guardar nuevo detalle compra
        guardarDetalleCompra($idCompra, $productos, $conexion, $deposito);
  
        cerrarConexion($conexion);
      }  

    function eliminarCompra($idCompra){
        $conexion = obtenerConexion();
  
        //ELIMINAR PAGOS DE LA COMPRA (TAMBIEN EN VENTA???) --> 7/3/22!!!!!!

        //Eliminar detalle compra
        eliminarDetalleCompra($idCompra, $conexion);
  
        //Eliminar compra (Encabezado)
        $consulta="DELETE FROM compras
                   WHERE id = $idCompra
        ";
  
        $resultado = $conexion->query($consulta);
  
        cerrarConexion($conexion);
    } */