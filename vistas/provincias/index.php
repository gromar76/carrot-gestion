<?php

 // accion viene determinado desde la direccion con la variable $a
    // y puede contener ---> listado, editar, ver, agregar, etc 
    
    
    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    // aqui guardo en data los js asociados a esa vista....
    $data["js"] = [ "provincias.js" ];

    switch($accion){
        case "listado":
            // armo un array data con el contenido y el header y footer decido si lo muestro o no
            $data["contenido"] = 'vistas/provincias/partials/listado.php';            
            $data["titulo"] = "Listado de Provincias";       
            include('vistas/base/index.php');

            break;


        case "agregar":
            $data["contenido"] = 'vistas/provincias/partials/editor.php';
            $data["titulo"] = "Agregando Provincia";
            include('vistas/base/index.php');

            break;


            case "editar":
                $data["contenido"] = 'vistas/provincias/partials/editor.php';
                $data["titulo"] = "Editando Provincia";
                include('vistas/base/index.php');
    
                break;
            

        case "listadoAjax":
            include('vistas/ajax/index.php');
            
            break;
    }

 
?>
