<?php
    // accion viene determinado desde la direccion con la variable $a
    // y puede contener ---> listado, editar, ver, agregar, etc    
    switch($accion){
        case "listado":
            $data["contenido"] =  'vistas/depositos/partials/listado.php';
            $data["titulo"] = "Listado de Depositos";
            break;

        case "editar":
            $data["contenido"] =  'vistas/depositos/partials/editor.php';
            $data["titulo"] = "Editando el Deposito";                       
            break;
        
        case "agregar":
            $data["contenido"] =  'vistas/depositos/partials/editor.php';
            $data["titulo"] = "Agregando el Deposito";            
            break;

              
        case "eliminar":
            $data["contenido"] =  'vistas/depositos/partials/listado.php';
            $data["titulo"] = "Eliminando Deposito";
            break;

         case "ver":
            // agarro el contenido y luego lo muestro en vistas/base/index.php
            $data["contenido"] =  'vistas/depositos/partials/editor.php';
            $data["titulo"] = "Viendo detalle de Deposito";
            break;

    }
    
    // por AGREGAR, EDITAR O VER voy siempre a vistas/clientes/partials/editor.php
    // ahi adentro voy manejandome de acuerdo a lo que tenga que hacer

    // armo un array data con el contenido y el header y footer decido si lo muestro o no
    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    $data["js"] = [ "depositos.js" ];    
        
    include('vistas/base/index.php');
?>
