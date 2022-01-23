<?php

    include 'funciones/conexion.php';

    function validarUsuario($usuario, $password){
        $conexion = obtenerConexion();
        $consulta = "SELECT * 
                     FROM usuarios
                     WHERE  email   = '$usuario'
                       AND password = '$password'";
        
        $resultado = $conexion->query($consulta);
        $registros = $resultado->fetch_all( MYSQLI_ASSOC ) ;

        cerrarConexion($conexion);

        $usuario = count($registros) == 1 ? $registros[0] : NULL;

        return $usuario;
    }