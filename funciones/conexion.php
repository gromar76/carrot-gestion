<?php

    function obtenerConexion(){

        $archivoConfiguracion = "config.ini";
        
        //aqui parseo el archivo ini y puedo acceder a sus datos luego
        $configuracion = parse_ini_file($archivoConfiguracion, true);

        $host     = $configuracion["bd"]["host"];
        $user     = $configuracion["bd"]["user"];
        $password = $configuracion["bd"]["password"];
        $database = $configuracion["bd"]["database"];
        
        $conexion = new mysqli( $host, $user, $password, $database );

        if ( $conexion->connect_errno ){
            echo "Error al conectar con la base de datos.";
        }

        return $conexion;

    }

    function cerrarConexion( $conexion ){
        $conexion->close();
    }

    function fetchAll( $resultado){
        $registros = [];

        while ( $registro = $resultado->fetch_assoc() ){
            $registros[] = $registro;
        }

        return $registros;
    }