<?php
    // accion viene determinado desde la direccion con la variable $a
    // y puede contener ---> listado, editar, ver, agregar, etc    
    switch($accion){
        case "listado":
            $data["contenido"] =  'vistas/pagos/partials/listado.php';
            $data["titulo"] = "Listado de Pagos";
            break;

         case "editar":
            $data["contenido"] =  'vistas/pagos/partials/editor.php';
            $data["titulo"] = "Editando el pago";                       
            break;

        case "ver":
            $data["contenido"] =  'vistas/pagos/partials/editor.php';
            $data["titulo"] = "Detalle de pago";                       
            break;
        
        case "agregar":
            $data["contenido"] =  'vistas/pagos/partials/editor.php';
            $data["titulo"] = "Agregando una pago";            
            break;

              
       /* case "eliminar":
            $data["contenido"] =  'vistas/ventas/partials/listado.php';
            $data["titulo"] = "Listado de Ventas";
            break;*/
         
    }
    
    // por AGREGAR, EDITAR O VER voy siempre a vistas/clientes/partials/editor.php
    // ahi adentro voy manejandome de acuerdo a lo que tenga que hacer

    // armo un array data con el contenido y el header y footer decido si lo muestro o no
    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    $data["js"] = [ "pagos.js" ];    
        
    include('vistas/base/index.php');
?>
