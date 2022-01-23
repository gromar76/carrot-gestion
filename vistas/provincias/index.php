<?php
    // armo un array data con el contenido y el header y footer decido si lo muestro o no
    $data["contenido"] =  'vistas/provincias/partials/listado.php';
    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    // aqui guardo en data los js asociados a esa vista....
    $data["js"] = [ "provincias.js" ];

    $data["titulo"] = "Provincias";

    include('vistas/base/index.php');
?>