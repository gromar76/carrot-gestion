<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosVentas(){

        $conexion = obtenerConexion();

        $consulta = 'SELECT ventas.*, cli.nombre, usr.nombre
                     FROM ventas
                     INNER JOIN clientes cli
                       ON cli.id = ventas.cliente
                     INNER JOIN usuarios usr
                       ON usr.id = ventas.id_usuario
                     ORDER BY fecha DESC';
        
        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;
    
        cerrarConexion($conexion);
    
        return $registros;

    }

    function obtenerPorIdVentas($id){

    }

    function agregarVenta($data){

    }

    function modificarVenta($data, $id){
        
    }

    function eliminarVenta($id){

    }