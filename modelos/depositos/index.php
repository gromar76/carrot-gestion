<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosDepositos(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM depositos";
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
        return $registros;
    }

    function obtenerDepositoDefault( $id_usuario ){
        $conexion = obtenerConexion();
        $consulta = "SELECT id_deposito_default
                     FROM usuarios
                     WHERE id = $id_usuario";

        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
        
        return $registros[0]["id_deposito_default"];
    }

    function obtenerDepositoPorId($id){   

/*         $conexion = obtenerConexion();
    
        $consulta = 'SELECT id, nombre
                     FROM depositos
                     WHERE id_provincia=' . $id .' order by nombre';
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);
    
        return $registros; */


    }
   

    function agregarDeposito($data){

    }

    function modificarDeposito($data, $id){
        
    }

    function eliminarDeposito($id){

    }