<?php
    function verificarDirectorio( $modulo ){
        if ( !is_dir("log/$modulo") ){
            mkdir("log/$modulo", 0777);
        }
    }

    function grabarLog($mensaje, $modulo){
        date_default_timezone_set(  'America/Argentina/Buenos_Aires' );

        verificarDirectorio( $modulo );

        $archivoLog = fopen("log/$modulo/log_$modulo.txt", "a");

        $hoy = date('d/m/y H:i:s');
        $usuario = $_SESSION["usuario"]['nombre'];


        fwrite( $archivoLog, "\n"  );
        fwrite( $archivoLog,  $hoy . "\t" .  $usuario . "\t" . $mensaje );

        fclose($archivoLog);
    }

    function armarDataParaLog($data){
        $keys = array_keys( $data);

        $dataLog = "\n";
 
        foreach( $keys as $key){
            $dataLog .=  $key != 'submit' ? $key . '=' . $data[$key] . "\n" : '';
        }

        return $dataLog;
    }

    function armarOriginalyModificado( $registroOriginal, $data){
        return "\nORIGINAL\n" . armarDataParaLog( $registroOriginal ) .
               "\nMODIFICADO\n" . armarDataParaLog( $data ); 
    }

    function armarMaestroDetalleJson( $data){
        return armarDataParaLogDesdeObjeto($data) . "\nDETALLE" . armarDataParaLogDesdeArrayDeObjetos($data->productos);
    }

    function armarDataParaLogDesdeObjeto($data){
        $keys =  array_keys((array)$data);

        $dataLog = "\n";
 
        foreach( $keys as $key){
            if ( !is_array($data->$key)){
                $dataLog .=  $key != 'submit' ? $key . '=' . $data->$key . "\n" : '';
            }
        }

        return $dataLog;
    }

    function armarDataParaLogDesdeArrayDeObjetos($data){
        
        $dataLog = "\n";
 
        foreach( $data as $registro){

            $dataLog .=  armarDataParaLogDesdeObjeto( $registro );
        }

        return $dataLog;
    }