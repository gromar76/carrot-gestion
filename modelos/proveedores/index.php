<?php

    include_once 'funciones/conexion.php';

    function obtenerTodos2(){
        $conexion = obtenerConexion();

        $consulta = "SELECT * FROM proveedores ORDER BY nombre";
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros;
    }

    function obtenerTodosProveedores(){
        $conexion = obtenerConexion();
        
        $consulta = 'SELECT *
                     FROM proveedores pro';
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros;
    }

    function dameNombreProveedor( $id ){
        $conexion = obtenerConexion();
        
        $consulta = "SELECT CONCAT(pro.nombre_empresa, ' ') nombre_completo
                     FROM proveedores pro
                     WHERE id = $id";
        
        $resultado = $conexion->query($consulta);
        $registros = fetchAll( $resultado );

        cerrarConexion($conexion);

        return $registros[0];
    }
    

    function obtenerPorIdProveedores($id){
        $conexion = obtenerConexion();
        
        $consulta = "SELECT cl.*, REPLACE(whatsapp, ' ', '') whatsapp, pro.id id_provincia, pa.id id_pais
                     FROM clientes cl
                     LEFT JOIN localidades lc
                     ON cl.id_localidad = lc.id
                     LEFT JOIN provincias pro
                     ON pro.id = lc.id_provincia
                     LEFT JOIN paises pa
                     ON pa.id = pro.pais_id
                     HAVING cl.id = $id";        


        $resultado = $conexion->query($consulta);
         $registros = fetchAll( $resultado );

        //var_dump($registros); exit;
        cerrarConexion($conexion);
        return $registros[0];
    }

    function agregarProveedores($data, $idUsuario){

        $conexion = obtenerConexion();

        $nombre             = $data["nombre"];
        $apellido           = $data["apellido"];
        $dni                = $data["dni"] ? $data["dni"] : NULL ;
        $whatsApp           = $data["whatsapp"];
        $telefono2          = $data["telefono2"];
        $email              = $data["email"];
        $paginaWeb          = $data["paginaweb"];
        $instagram          = $data["instagram"];
        $facebook           = $data["facebook"];
        $idLocalidad        = $data["id_localidad"] == -1 ? 'NULL' : $data["id_localidad"];  
        $domicilio          = $data["domicilio"];    
        $cPostal            = $data["cpostal"];
        $observaciones      = $data["observaciones"];
        $esDistribuidor     = $data["es_distribuidor"];
        $esClienteDe        = $data["es_cliente_de"];
        $usuarioAlta        = $idUsuario;

        $consulta="insert into clientes (nombre, apellido, dni, whatsapp, telefono2, email, paginaweb, instagram, facebook,
        id_localidad, domicilio, cpostal, observaciones, es_distribuidor, es_cliente_de, usuario_alta)
         values ('$nombre', '$apellido', " . ($dni ? "'" . $dni . "'"  : 'NULL') . ", '$whatsApp', '$telefono2', '$email', '$paginaWeb', '$instagram'
         , '$facebook', '$idLocalidad', '$domicilio', '$cPostal', '$observaciones', '$esDistribuidor'
         , '$esClienteDe', $usuarioAlta )";

        $resultado = $conexion->query($consulta);

        cerrarConexion($conexion);

    }

    function modificarProveedores($data, $id){
        $conexion = obtenerConexion();

        $nombre             = $data["nombre"];
        $apellido           = $data["apellido"];
        $dni                = $data["dni"];
        $whatsApp           = $data["whatsapp"];
        $telefono2          = $data["telefono2"];
        $email              = $data["email"];
        $paginaWeb          = $data["paginaweb"];
        $instagram          = $data["instagram"];
        $facebook           = $data["facebook"];
        $idLocalidad        = $data["id_localidad"] == -1 ? 'NULL' : $data["id_localidad"];    
        $domicilio          = $data["domicilio"];    
        $cPostal            = $data["cpostal"];
        $observaciones      = $data["observaciones"];
        $esDistribuidor     = $data["es_distribuidor"];
        $esClienteDe        = $data["es_cliente_de"];

        $consulta="UPDATE clientes SET 
                    nombre          = '$nombre',
                    apellido        = '$apellido',
                    dni             = '$dni',
                    whatsapp        = '$whatsApp',
                    telefono2       = '$telefono2',
                    email           = '$email',
                    paginaweb       = '$paginaWeb',
                    instagram       = '$instagram',
                    facebook        = '$facebook',
                    id_localidad    = $idLocalidad,
                    domicilio       = '$domicilio',
                    cpostal         = '$cPostal',
                    observaciones   = '$observaciones',
                    es_distribuidor = '$esDistribuidor',
                    es_cliente_de   = '$esClienteDe'        
                   WHERE id = $id";

        $resultado = $conexion->query($consulta);
        cerrarConexion($conexion);
    }

    function eliminarProveedores($id){
        $conexion = obtenerConexion();

        $consulta = "DELETE FROM clientes WHERE id=$id";

        $resultado = $conexion->query($consulta);
        cerrarConexion($conexion);
    }

  function esProveedorExistente($whatsapp){
    $conexion = obtenerConexion();

    $ultimos7DigitosWhatsapp = substr($whatsapp, -7);
 
    $consulta = "SELECT * FROM 
                 clientes WHERE
                 whatsapp LIKE '%$ultimos7DigitosWhatsapp%'";

    $resultado = $conexion->query($consulta);

    $existe = $resultado->num_rows == 1;

    cerrarConexion($conexion);

    return $existe;
  }