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