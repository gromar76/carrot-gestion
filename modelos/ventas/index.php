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



    function agregarVenta($data){

      $conexion = obtenerConexion();

      $tipofact    = $data["nombre"];
      $numfact     = $data["apellido"];
      $cliente     = $data["cliente"];
      $importe     = $data["whatsapp"];
      $fecha       = $data["telefono2"];      
      $id_usuario  = $idUsuario;
      $comentario  = $data["comentario"];
      
      $consulta="insert into ventas (tipofact, numfact, cliente, importe, fecha, id_usuario, comentario)
       values ('$tipofact', '$numfact', '$cliente', '$importe', '$fecha', $id_usuario, $comentario )";

      $resultado = $conexion->query($consulta);
      cerrarConexion($conexion);

    }



    function modificarVenta($data, $id){
        
    }

    

    function eliminarVenta($id){

    }