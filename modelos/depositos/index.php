<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosDepositos(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM depositos ORDER BY nombre";
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );
        return $registros;
    }


    function obtenerPorId($id){
   

        $conexion = obtenerConexion();
    
        $consulta = 'SELECT id, nombre
                     FROM depositos
                     WHERE id_provincia=' . $id .' order by nombre';
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);
    
        return $registros;


    }
   

    function agregarDeposito($data){

    }

    function modificarDeposito($data, $id){
        
    }

    function eliminarDeposito($id){

    }