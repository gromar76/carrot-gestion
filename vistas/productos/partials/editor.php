<?php

include 'funciones/html.php';

// este archivo debe manejar el AGREGAR,VER Y EDITAR ----> PRODUCTOS

//si la accion es EDITAR O VER debo mostrar los valores, solo no muestro cuando es alta
// si la accion es modificar, entonces tomo los datos,  

$nombre         = isset($data['registros']['nombre']) ? $data['registros']['nombre'] : '';
$descripcion    = isset($data['registros']['descripcion']) ? $data['registros']['descripcion'] : '';
//$precio         = isset($data['registros']['precio']) ? $data['registros']['precio'] : '';
$precio         = isset($data['registros']['precio']) ? $data['registros']['precio'] : 0;
$idCategoria    = isset($data['registros']['id_categoria']) ? $data['registros']['id_categoria'] : '';

//Todas las categorias
$categoriasDeProducto = obtenerTodosCatProd();

// si la accion es VER entonces disabled esta vacio
$disabled =  $accion == 'ver' ? "disabled" : "";

// la variable $accion viene con agregar, editar, ver
//echo $accion;

?>

<div class="row d-flex justify-content-center">
    <?php // si existe $data["registros"]["id"] es porque estoy modificando?>
    <form method="post" action="index.php?m=productos&a=<?= isset($data["registros"]["id"]) ? "editar&id=" . $data['registros']['id'] : "agregar" ?>"
        class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">

        <div class="form-group row"> 
            <label for="nombre" class="col-3 col-form-label">Nombre</label> 
            <div class="col-9">
            <input id="nombre" name="nombre" type="text" class="form-control" <?=$disabled?>  value="<?=$nombre?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="descripcion" class="col-3 col-form-label">Descripcion</label> 
            <div class="col-9">
            <input id="descripcion" name="descripcion" type="text" class="form-control" <?=$disabled?> value="<?=$descripcion?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="precio" class="col-3 col-form-label">Precio</label> 
            <div class="col-9">
            <input id="precio" name="precio" type="text" class="form-control" <?=$disabled?> value="<?=$precio?>">
            </div>
        </div>     
        
        <div class="form-group row">            
            <label for="categoria" class="col-3 col-form-label">Categoria</label> 
            <div class="col-9">
              
                <select id="id_categoria" name="id_categoria" data-id-original="<?=$idCategoria?>" class="custom-select" <?=$disabled?>>
                    <?= dameOpcionesDelSelect($categoriasDeProducto,  $idCategoria); ?>
                </select>
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