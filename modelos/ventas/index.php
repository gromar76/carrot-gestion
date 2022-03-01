<?php

    include_once 'funciones/conexion.php';
    include_once 'modelos/pagos/index.php';

    function obtenerTodosVentas(){

        $conexion = obtenerConexion();

        $consulta = 'SELECT ventas.id, ventas.fecha, ventas.importe, CONCAT(cli.nombre, " ", cli.apellido) cliente, usr.nombre usuario, usr.id id_usuario,
                            ventas.pagado
                     FROM ventas 
                       INNER JOIN clientes cli 
                     ON cli.id = ventas.cliente
                       INNER JOIN usuarios usr 
                     ON usr.id = ventas.id_usuario 
                       ORDER BY ventas.fecha desc';
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);    
        return $registros;

    }



    function obtenerPorIdVentas($id){
      $conexion = obtenerConexion();

      $consulta = "SELECT ventas.*, CONCAT(nombre, ' ', apellido) cliente, cli.id id_cliente
                   FROM ventas 
                   INNER JOIN clientes cli 
                   ON cli.id = ventas.cliente 
                   WHERE ventas.id = $id";

      $resultado = $conexion->query($consulta);
      $venta = fetchAll( $resultado );

      $consulta = "SELECT prod.nombre, dv.id_articulo id, dv.cant cantidad, dv.precio precioUnit
                   FROM detalle_ventas dv
                   INNER JOIN productos prod
                   ON prod.id = dv.id_articulo
                   WHERE id_venta = $id";

      $resultado = $conexion->query($consulta);
      $detalleVenta = fetchAll( $resultado );

      cerrarConexion($conexion);   

      return [ "venta" => $venta[0], "productos" => $detalleVenta ];
    }

    function calcularTotal($productos){
      $total = 0;
      
      foreach ( $productos as $producto  ){
        $total += $producto->precioUnit * $producto->cantidad;
      }

      return $total;
    }


    function guardarDetalleVenta($idVenta, $productos, $conexion){
      foreach ( $productos as $producto  ){
        $consulta="INSERT INTO detalle_ventas (id_venta, id_articulo, cant, precio)
                   VALUES ( $idVenta, $producto->id, $producto->cantidad, $producto->precioUnit )";

        $resultado = $conexion->query($consulta);                  
      }
    }

    function eliminarDetalleVenta($idVenta, $conexion){
      $consulta="DELETE FROM detalle_ventas
                 WHERE id_venta=$idVenta
                ";

      $resultado = $conexion->query($consulta);
    }


    function agregarVenta($data, $idUsuario){      
      $conexion = obtenerConexion();
 
      $cliente                 = $data->cliente;
      $fecha                   = $data->fecha;      
      $comentario              = $data->observaciones;        
      $productos               = $data->productos;
      $importe                 = calcularTotal($productos);   

      $primerPago              = $data->primerPago;
      $observacionesPrimerPago = $data->observacionesPrimerPago;
           
      $consulta="INSERT INTO ventas (cliente, importe, fecha, id_usuario, comentario)
                 VALUES ( $cliente, $importe, '$fecha', $idUsuario, '$comentario' )";

      $resultado = $conexion->query($consulta);

      $idVenta = $conexion->insert_id;

      guardarDetalleVenta($idVenta, $productos, $conexion); 

      //VERIFICO SI HAY PRIMER PAGO Y SI ES ASI, LO GUARDO 
      $data = [];

      if ( $primerPago > 0 ) {

        $data["importe"]       = $primerPago;
        $data["fecha"]         = $fecha;
        $data["observaciones"] = $observacionesPrimerPago;

        agregarPago($data, $idVenta);
      }

      cerrarConexion($conexion);
    }


    function modificarVenta($idVenta, $data, $usuario){
      $conexion = obtenerConexion();
 
      $cliente     = $data->cliente;
      $fecha       = $data->fecha;      
      $comentario  = $data->observaciones;        
      $productos   = $data->productos;
      $importe     = calcularTotal($productos);      
           
      //Actualizo el encabezado de la venta 
      $consulta="UPDATE ventas 
                    SET cliente    = $cliente,
                        importe    = $importe,
                        fecha      = '$fecha',
                        comentario = '$comentario'
                    WHERE id = $idVenta
                 ";

      $resultado = $conexion->query($consulta);

      //Eliminar detalle de venta anterior
      eliminarDetalleVenta($idVenta, $conexion);

      //Guardar nuevo detalle venta
      guardarDetalleVenta($idVenta, $productos, $conexion);

      cerrarConexion($conexion);
    }  

    function eliminarVenta($idVenta){
      $conexion = obtenerConexion();

      //Eliminar detalle venta
      eliminarDetalleVenta($idVenta, $conexion);

      //Eliminar venta (Encabezado)
      $consulta="DELETE FROM ventas
                 WHERE id = $idVenta
      ";

      $resultado = $conexion->query($consulta);

      cerrarConexion($conexion);
    }