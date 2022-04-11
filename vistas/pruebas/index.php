<?php

 // accion viene determinado desde la direccion con la variable $a
    // y puede contener ---> listado, editar, ver, agregar, etc 
    
    
    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    // aqui guardo en data los js asociados a esa vista....
    $data["js"] = [ "pruebas.js" ];

    switch($accion){
        case "prueba1":
            // armo un array data con el contenido y el header y footer decido si lo muestro o no
            $data["contenido"] = 'vistas/pruebas/partials/listado.php';            
            $data["titulo"] = "PRUEBA";       
            include('vistas/base/index.php');

            break;

        
    }

 
?>
