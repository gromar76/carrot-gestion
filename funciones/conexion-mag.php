<?php

    function obtenerConexion(){

        $archivoConfiguracion = "config-mag.ini";
        
        //aqui parseo el archivo ini y puedo acceder a sus datos luego
        $configuracion = parse_ini_file($archivoConfiguracion, true);

        $host     = $configuracion["bd"]["host"];
        $user     = $configuracion["bd"]["user"];
        $password = $configuracion["bd"]["password"];
        $database = $configuracion["bd"]["database"];
        
        //$conexion = new mysqli( $host, $user, $password, $database );

        $serverName = "MLI-SVR-SQL"; //serverName\instanceName
        $connectionInfo = array( "Database"=>"hacienda", "UID"=>"nicolas", "PWD"=>"mecano");
        $conn = sqlsrv_connect( $serverName, $connectionInfo);
        
        if( $conn ) {
             echo "Conexión establecida.<br />";
        }else{
             echo "Conexión no se pudo establecer.<br />";
             die( print_r( sqlsrv_errors(), true));
        }

        exit();




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