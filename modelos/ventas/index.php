<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosVentas(){

        $conexion = obtenerConexion();

        $consulta = 'SELECT ventas.id, ventas.fecha, ventas.importe, CONCAT(cli.nombre, " ", cli.apellido) cliente, usr.nombre usuario 
                     FROM ventas 
                       INNER JOIN clientes cli 
                     ON cli.id = ventas.cliente
                       INNER JOIN usuarios usr 
                     ON usr.id = ventas.id_usuario 
                       ORDER BY fecha DESC';
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);    
        return $registros;

    }



    function obtenerPorIdVentas($id){

    }

    function calcularTotal($productos){
      $total = 0;
      
      foreach ( $productos as $producto  ){
        $total += $producto->precioUnit * $producto->cantidad;
      }

      return $total;
    }

    function agregarVenta($data, $idUsuario){      
      $conexion = obtenerConexion();
 
      $cliente     = $data->cliente;
      $fecha       = $data->fecha;      
      $comentario  = $data->observaciones;        
      $productos   = $data->productos;
      $importe     = calcularTotal($productos);      
           
      $consulta="INSERT INTO ventas (cliente, importe, fecha, id_usuario, comentario)
                 VALUES ( $cliente, $importe, '$fecha', $idUsuario, '$comentario' )";

      $resultado = $conexion->query($consulta);

      $idVenta = $conexion->insert_id;

      foreach ( $productos as $producto  ){
        $consulta="INSERT INTO detalle_ventas (id_venta, id_articulo, cant, precio)
                   VALUES ( $idVenta, $producto->id, $producto->cantidad, $producto->precioUnit )";

        $resultado = $conexion->query($consulta);                  
      }

      cerrarConexion($conexion);
    }



    function modificarVenta($data, $id){
        
    }

    

    function eliminarVenta($id){

    }