<?php

    include_once 'funciones/conexion.php';

    function obtenerTodosDepositos(){
        $conexion = obtenerConexion();
        $consulta = "SELECT * FROM depositos";
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
        return $registros;
    }

    function obtenerDepositosUsuario($idUsuario){
        $conexion = obtenerConexion();
        $consulta = "SELECT dp.*
                     FROM usuarios_depositos ud
                     INNER JOIN depositos dp
                     ON dp.id = ud.id_deposito
                     WHERE ud.id_usuario = $idUsuario";

        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
        return $registros;
    }

    function obtenerDepositosDestino( $id_origen ){
        $conexion = obtenerConexion();
        
        $consulta = "SELECT * 
                     FROM depositos
                     WHERE id <> $id_origen";

        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        return $registros;       
    }

    function obtenerUsuariosDelDepositoAjax( $idDeposito ){
        $conexion = obtenerConexion();
        
        $consulta = "SELECT usr.id, usr.nombre
                     FROM usuarios_depositos ud
                     INNER JOIN usuarios usr
                     ON usr.id = ud.id_usuario
                     WHERE ud.id_deposito = $idDeposito";

        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        return $registros;       
    }

    function obtenerDepositoDefault( $idUsuario ){
        $conexion = obtenerConexion();
        $consulta = "SELECT id_deposito_default
                     FROM usuarios
                     WHERE id = $idUsuario";

        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );
        
        return $registros[0]["id_deposito_default"];
    }

    function obtenerDepositoPorId($id){   

     $conexion = obtenerConexion();
    
        $consulta = "SELECT id, nombre
                     FROM depositos
                     WHERE id=$id";
        
        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );
    
        cerrarConexion($conexion);
    
        return $registros[0];


    }
   

    function agregarDeposito($data){
        $conexion = obtenerConexion();

        $nombre      = $data["nombre"];
                
        $consulta = "INSERT INTO depositos (nombre) VALUES ('$nombre')";
        $resultado = $conexion->query($consulta);

        cerrarConexion($conexion);
    }

    function modificarDeposito($data, $id){

        $conexion = obtenerConexion();
        $nombre      = $data["nombre"];            
        $consulta="UPDATE depositos
                     SET nombre = '$nombre'                                      
                   WHERE id = $id";
        $resultado = $conexion->query($consulta);        
        cerrarConexion($conexion);
    }



    function eliminarDeposito($id){

    }