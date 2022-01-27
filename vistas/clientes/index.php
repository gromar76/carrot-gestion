<?php
    // accion viene determinado desde la direccion con la variable $a
    // y puede contener ---> listado, editar, ver, agregar, etc    
    switch($accion){
        case "listado":
            $data["contenido"] = 'vistas/clientes/partials/listado.php';
            $data["titulo"] = "Listado de Clientes";
            break;

        case "editar":
            $data["contenido"] = 'vistas/clientes/partials/editor.php';
            $data["titulo"] = "Editando el Cliente";                       
            break;
        
        case "agregar":
            $data["contenido"] = 'vistas/clientes/partials/editor.php';
            $data["titulo"] = "Agregando el Cliente";            
            break;

              
        case "eliminar":
            $data["contenido"] = 'vistas/clientes/partials/listado.php';
            $data["titulo"] = "Listado de Clientes";
            break;

         case "ver":
            // agarro el contenido y luego lo muestro en vistas/base/index.php
            $data["contenido"] = 'vistas/clientes/partials/editor.php';
            $data["titulo"] = "Viendo detalle de Cliente";
            break;

    }
    
    // por AGREGAR, EDITAR O VER voy siempre a vistas/clientes/partials/editor.php
    // ahi adentro voy manejandome de acuerdo a lo que tenga que hacer

    // armo un array data con el contenido y el header y footer decido si lo muestro o no
    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    $data["js"] = [ "clientes.js" ];    
        
    include('vistas/base/index.php');
?>
