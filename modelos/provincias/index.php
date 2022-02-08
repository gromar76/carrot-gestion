<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosProvincias(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM provincias ORDER BY nombre";
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros;
    }

    function obtenerPorIdProvincias($id){

        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM provincias where pais_id=$id ORDER BY nombre";        

        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros;
    }

    function agregarProvincia($data){
        $conexion = obtenerConexion();

        $nombre = $data["nombre"]; 
        $idPais = $data["id_pais"]; 
        
        $consulta = "INSERT INTO provincias (nombre, pais_id) VALUES ('$nombre', '$')";
                
        $resultado = $conexion->query($consulta);
        cerrarConexion($conexion);
    }




    function modificarCatProv($data, $id){
        
    }
    
    
    
    function eliminarCatProv($id){

    }




    function obtenerTodosProvinciasTabla(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM provincias ORDER BY nombre";
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros;
    }