<?php
    // armo un array data con el contenido y el header y footer decido si lo muestro o no
    $data["contenido"] =  'vistas/categorias/partials/listado.php';
    $data["mostrar_header"] = TRUE;
    $data["mostrar_footer"] = TRUE;
    // aqui guardo en data los js asociados a esa vista....
    $data["js"] = [ "categorias.js", "pepe.js", "nico.js" ];

    //var_dump($data);


echo $data["js"][0];
echo '<br>';
echo $data["js"][1];
echo '<br>';
echo $data["js"][2];

?>