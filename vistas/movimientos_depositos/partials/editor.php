<?php

include 'funciones/html.php';

$productos        = $data["productos"];
$depositos        = $data["depositos"];
/* $deposito         = isset( $data["deposito"] ) ?  $data["deposito"]  : NULL; */

//var_dump ($proveedores);exit();

// si la accion es VER entonces pongo disabled para que no se pueda editar el campo input, de lo contrario no pongo nada entonces se puede editar
$disabled =  $accion == 'ver' ? "disabled" : ""; 

// la variable $accion viene con agregar, editar, ver
//echo $accion;
?>

<div class="row d-flex justify-content-center">

    <div class="row w-75">
        <form method="post" class="col-12 col-sm-10 col-md-8 col-lg-8">

            <div class="col">
                <div class="form-group row">
                    <label for="fecha" class="col-3 col-form-label">Fecha</label> 
                    <div class="col-9">
                    <input id="fecha" name="fecha" type="date" class="form-control" <?=$disabled?>>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="origen" class="col-3 col-form-label">Origen</label> 

                    <div class="col-9">

                        <select class="form-control" id="origen" value="Cargando..." <?=$disabled?>>
                            <?= dameOpcionesDelSelect( $depositos );  ?>
                        </select>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="destino" class="col-3 col-form-label">Destino</label> 

                    <div class="col-9">

                        <select class="form-control" id="destino" value="Cargando..." <?=$disabled?>>
                            <?= dameOpcionesDelSelect( $depositos);  ?>
                        </select>

                    </div>
                </div>

            </div>
            

        </form>
    </div>

    <?php if ( !$disabled ) { ?>
        <div class="row w-75">
            <div class="col">
                <button id="btn-modal-agregar-producto" class="btn btn-primary" >Agregar producto</button>
            </div>
        </div>
    <?php } ?>
    
    <div class="row w-75">
        <div class="col">
            <table class="table mt-3">
                <thead>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </thead>

                <tbody id="detalle-movimiento-deposito">

                </tbody>
            </table>
        </div>
    </div>      
    
    <div class="row w-100">
        <div class="col ml-4">
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" class="form-control" <?php echo $disabled?> id="observaciones" rows="5"></textarea>
            </div>
        </div>
    </div>
        
    <div class="form-group row w-75">
        <div class="col text-center">                
            <?php 
                // si la accion es distinto de VER es porque estoy haciendo un alta o modificacion
                // entonces tiene que tener el boton de GUARDAR
                if ( $accion != 'ver' ){ ?>
                <button id="btn-guardar" class="btn btn-primary">Guardar Movimiento</button>              
            <?php }?>

            <input id="btn-atras" class="btn btn-primary" type="reset" value= "<?= $accion == 'ver' ? 'Volver' : 'Cancelar' ?>" >
        </div>            
    </div>

    <!-- Modal Agregar Producto a Detalle -->
    <div class="modal fade" id="modal-agregar-producto" data-backdrop="static" data-keyboard="false" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 id="titulo-modal-agregar-producto" class="modal-title">Agregar producto</h5>
                <button type="button" class="close" data-dismiss="modal" >
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-producto-detalle" method="post" class="col-12 col-sm-10 col-md-10">

                    <div class="col">
                        <div class="form-group row">
                            <label for="producto" class="col-3 col-form-label">Producto</label> 
                            <div class="col-9">
                                <select id="producto" name="producto" class="custom-select" <?=$disabled?> value="<?=$producto?>">
                                    <option value="-1">Seleccione el producto...</option>
                                    <?= dameOpcionesDelSelect($productos); ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cantidad" class="col-3 col-form-label">Cant.</label> 
                            <div class="col-9">
                            <input id="cantidad" name="cantidad" type="number" class="form-control" <?=$disabled?> value="<?=$cantidad?>">
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">                
                <button id="btn-agregar-detalle" type="button" class="btn btn-primary">Aceptar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Modal Agregar Producto a Detalle -->    

</div>
