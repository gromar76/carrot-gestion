<?php
    // armo un array data con el contenido y el header y footer decido si lo muestro o no
    $data["contenido"] =  'vistas/localidades/partials/listado.php';
    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    $data["js"] = [ "localidades.js" ];

    
    include('vistas/base/index.php');
?>
