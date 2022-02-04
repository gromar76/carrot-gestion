<?php
    // armo un array data con el contenido y el header y footer decido si lo muestro o no

    switch($accion){
        case "listado":
            $data["contenido"] =  'vistas/categorias/partials/listado.php';            
            $data["titulo"] = "Listado de Categorias";
            break;

        case "editar":
            $data["contenido"] =  'vistas/categorias/partials/editor.php';
            $data["titulo"] = "Editando el Categoria";                       
            break;

        case "agregar":
            $data["contenido"] = 'vistas/categorias/partials/editor.php';
            $data["titulo"] = "Agregando la Categoria";            
            break;
            

    }

    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    // aqui guardo en data los js asociados a esa vista....
    $data["js"] = [ "categorias.js" ];
    
    include('vistas/base/index.php');
?>