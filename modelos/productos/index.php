<?php

    include_once 'funciones/conexion.php';

    function obtenerTodos(){
        $conexion = obtenerConexion();
        $consulta = "SELECT art.id, art.nombre, art.precio, cat.id as id_categoria, cat.nombre as nomcat
                     FROM productos art, categorias_productos cat
                     WHERE art.id_categoria=cat.id
                     ORDER BY art.nombre";
        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;
        return $registros;
    }

    function obtenerPorId($id){
        $conexion = obtenerConexion();
        
        /*$consulta = "SELECT ar.*, ca.id id_categoria
                     FROM productos ar
                     LEFT JOIN categorias ca
                     ON ar.id_categoria = ca.id                     
                     HAVING ar.id = $id";  */

        $consulta = "SELECT ar.*, ca.id id_categoria, ca.nombre as nomcat
                     FROM productos ar, categorias_productos ca
                     WHERE ar.id_categoria=ca.id and ar.id=$id";

        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;

        cerrarConexion($conexion);
        return $registros[0];
    }

    function agregar($data, $id){
        $conexion = obtenerConexion();
        $nombre      = $data["nombre"];
        $descripcion = $data["descripcion"];
        $precio      = $data["precio"];                    
        $idCategoria = $data["id_categoria"];

        $consulta = "INSERT into productos (nombre, descripcion, precio, id_categoria)
                     VALUES ('$nombre', '$descripcion', $precio, $idCategoria)";

        //echo $consulta; exit();

        $resultado = $conexion->query($consulta);
        
        cerrarConexion($conexion);
    }      
    
    function modificar($data, $id){
        $conexion = obtenerConexion();

        $nombre      = $data["nombre"];
        $descripcion = $data["descripcion"];
        $precio      = $data["precio"];                    
        $idCategoria = $data["id_categoria"] == -1 ? 'NULL' : $data["id_categoria"];

        $consulta="UPDATE productos SET 
                          nombre       = '$nombre',
                          descripcion  = '$descripcion',
                          precio       = '$precio',                   
                          id_categoria = '$idCategoria'                  
                   WHERE id = $id";

        $resultado = $conexion->query($consulta);
        
        cerrarConexion($conexion);
    }  
    
    
    function eliminar($id){

    }