<?php

include 'funciones/html.php';


$idLocalidad   = isset($data['registros']['idLocalidad']) ? $data['registros']['idLocalidad'] : '';
$nomLocalidad  = isset($data['registros']['nomLocalidad']) ? $data['registros']['nomLocalidad'] : '';
$nomProvincia  = isset($data['registros']['nomProvincia']) ? $data['registros']['nomProvincia'] : '';
$nomPais       = isset($data['registros']['nomPais']) ? $data['registros']['nomPais'] : '';


//var_dump($data['registros']); exit();


// si la accion es VER entonces disabled esta vacio
$disabled =  $accion == 'ver' ? "disabled" : ""; 

// la variable $accion viene con agregar, editar, ver
//echo $accion;

?>

<div class="row d-flex justify-content-center">
    <form method="post" action="index.php?m=localidades&a=<?= isset($data["registros"]["id"]) ? "editar&id=" . $data['registros']['id'] : "agregar" ?>"
        class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">

        <div class="form-group row"> 
            <label for="nombre" class="col-3 col-form-label">Localidad</label> 
            <div class="col-9">
            <input id="nombre" name="nombre" data-id-original="<?=$idCategoria?>" type="text" class="form-control" <?=$disabled?>  value="<?=$nomLocalidad?>">
            </div>
        </div>
        <div class="form-group row"> 
            <label for="nombre" class="col-3 col-form-label">Provincia</label> 
            <div class="col-9">
            <input id="nombre" name="nombre" data-id-original="<?=$idCategoria?>" type="text" class="form-control" <?=$disabled?>  value="<?=$nomProvincia?>">
            </div>
        </div> 
        <div class="form-group row"> 
            <label for="nombre" class="col-3 col-form-label">Pais</label> 
            <div class="col-9">
            <input id="nombre" name="nombre" data-id-original="<?=$idCategoria?>" type="text" class="form-control" <?=$disabled?>  value="<?=$nomPais?>">
            </div>
        </div> 
        <div class="form-group row">
            <div class="col text-center">                
                <?php 
                    // si la accion es distinto de VER es porque estoy haciendo un alta o modificacion
                    // entonces tiene que tener el boton de GUARDAR
                    if ( $accion != 'ver' ){ ?>
                    <button name="submit" type="submit" class="btn btn-primary">Guardar</button>                
                <?php }?>
                <input id="btn-atras" class="btn btn-primary" type="reset" value= "<?= $accion == 'ver' ? 'Volver' : 'Cancelar' ?>" >
            </div>            
        </div> 
    </form>
</div>