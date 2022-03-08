<?php

include 'funciones/html.php';

// este archivo debe manejar el AGREGAR,VER Y EDITAR ----> PAGOS

//si la accion es EDITAR O VER debo mostrar los valores, solo no muestro cuando es alta
// si la accion es modificar, entonces tomo los datos,  

function dameFechaDeHoy(){
    return  date('Y-m-d');
}

$pendiente = $data["compra"]["importe"] - $data["compra"]["pagado"];

$fecha         = isset($data['registros']['fecha']) ? $data['registros']['fecha'] : dameFechaDeHoy();
$importe       = isset($data['registros']['importe']) ? $data['registros']['importe'] : $pendiente;
$observaciones = isset($data['registros']['observaciones']) ? $data['registros']['observaciones'] : '';

// si la accion es VER entonces disabled esta vacio
$disabled =  $accion == 'ver' ? "disabled" : ""; 

// la variable $accion viene con agregar, editar, ver
//echo $accion;

include('resumen_compra.php');
?>

<div class="row d-flex justify-content-center" style="margin-top: 20px !important;">
    <form method="post" action="index.php?m=pagos_compras&a=<?= isset($data["registros"]["id"]) ? "editar&id=" . $data['registros']['id'] . "&idCompra=" . $_GET['idCompra'] : "agregar&idCompra=".$_GET['idCompra']?>"
        class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">

        <div class="form-group row"> 
            <label for="fecha" class="col-3 col-form-label">Fecha</label> 
            <div class="col-9">
            <input id="fecha" name="fecha" type="date" class="form-control" <?=$disabled?>  value="<?=$fecha?>">
            </div>
        </div> 

        <div class="form-group row"> 
            <label for="importe" class="col-3 col-form-label">Importe</label> 
            <div class="col-9">
            <input id="importe" name="importe" type="text" class="form-control" <?=$disabled?>  value="<?=$importe?>">
            </div>
        </div> 

        <div class="form-group row"> 
            <label for="observaciones" class="col-3 col-form-label">Observaciones</label> 
            <div class="col-9">
                <textarea id="observaciones" name="observaciones" type="text" class="form-control" <?=$disabled?> ><?=$observaciones?></textarea>
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