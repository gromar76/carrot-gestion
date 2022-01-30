<?php

    include 'funciones/conexion.php';

    function validarUsuario($usuario, $password){
        $conexion = obtenerConexion();
        $consulta = "SELECT * 
                     FROM usuarios
                     WHERE  email   = '$usuario'
                       AND password = '$password'";
        
        $resultado = $conexion->query($consulta);

        $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        $usuario = count($registros) == 1 ? $registros[0] : NULL;

        return $usuario;
    }