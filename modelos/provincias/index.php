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

    function obtenerPorIdProvinciasDeUnPais($idPais){
        
        $conexion = obtenerConexion();
    
        $consulta = "SELECT * FROM provincias WHERE pais_id=$idPais ORDER BY nombre";        

        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );       

        cerrarConexion($conexion);

        return $registros;
    }

    function obtenerPorIdProvincia($idProvincia){
        
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM provincias WHERE id=$idProvincia";        

        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );       

        cerrarConexion($conexion);

        return $registros[0];
    }


    function agregarProvincia($data){
        $conexion = obtenerConexion();


        //var_dump($data);exit();

        $nombre = $data["nombre"]; 
        $idPais = intval($data["id_pais"]); 

        //echo $nombre;
        //echo $idPais;
        //exit();
        
        
        $consulta = "INSERT INTO provincias (nombre, pais_id) VALUES ('$nombre', '$idPais')";

        //echo $consulta;exit();
                
        $resultado = $conexion->query($consulta);
        cerrarConexion($conexion);

        guardarLog('AGREGO PROVINCIA ' . $nombre . "(idPais=$idPais)");
    }


    function modificarProvincia(){

    }




    function modificarCatProv($data, $id){
        
    }
    
    
    function eliminarCatProv($id){

    }

    function obtenerTodosProvinciasTabla(){
        $conexion = obtenerConexion();
        $consulta = "SELECT pro.id id, pro.nombre nombre, pa.id pais_id, pa.nombre pais_nombre
                     FROM provincias pro, paises pa
                     WHERE pro.pais_id = pa.id";     
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        cerrarConexion($conexion);       
        
        guardarLog('Se pidio listado de provincias');

        return $registros;
    }

