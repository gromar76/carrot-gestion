<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosLocalidades(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM localidades ORDER BY nombre";
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );
        return $registros;
    }


    function obtenerTodosLocalidades2(){
        $conexion = obtenerConexion();
        $consulta = 'SELECT loc.id as idLocalidad, loc.nombre as nomLocalidad, pro.nombre as nomProvincia, pai.nombre  as nomPais
                     FROM localidades loc, provincias pro, paises pai 
                     WHERE loc.id_provincia=pro.id and pro.pais_id=pai.id                      
                     ORDER BY loc.nombre';
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
        return $registros;
    }



    function obtenerPorIdLocalidad2($id){   

        $conexion = obtenerConexion();    
        $consulta = "SELECT loc.id as idLocalidad, loc.nombre as nomLocalidad, pro.nombre as nomProvincia, pai.nombre  as nomPais
                     FROM localidades loc, provincias pro, paises pai 
                     WHERE loc.id_provincia=pro.id and pro.pais_id=pai.id and loc.id=$id";
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);
    
        return $registros[0];
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