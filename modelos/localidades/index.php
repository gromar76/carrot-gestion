<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosLocalidades(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM localidades ORDER BY nombre";
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );
        return $registros;
    }


    function obtenerPorIdLocalidades($id){
   

        $conexion = obtenerConexion();
    
        $consulta = 'SELECT id, nombre
                     FROM localidades
                     WHERE id_provincia=' . $id .' order by nombre';
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);
    
        return $registros;


    }
   

    function agregarLocalidad($nombreLocalidad, $idProvincia){
        $conexion = obtenerConexion();
    
        $consulta = "INSERT INTO localidades(nombre, id_provincia)
                     VALUES ('$nombreLocalidad', $idProvincia)
                    ";
        
        $conexion->query($consulta);
        
        $idNuevaLocalidad = $conexion->insert_id;

        cerrarConexion($conexion);
            
        return $idNuevaLocalidad;
    }

    function modificarLocalidad($data, $id){
        
    }

    function eliminarLocalidad($id){

    }