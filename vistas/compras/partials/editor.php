<?php

include 'funciones/html.php';

// este archivo debe manejar el AGREGAR,VER Y EDITAR ----> CLIENTE
// si la accion es editar o ver, guardo en la variable el dato, sino pongo espacio vacio porque voy a dar de alta

// si existe registros nombre, entonces a $nombre ponele $data['registros']['nombre'], sino ponele ''

/* $cliente        = isset($data['registros']['cliente']) ? $data['registros']['cliente'] : '';
$fecha          = isset($data['registros']['fecha'])  ? $data['registros']['fecha'] : '';
$observaciones  = isset($data['registros']['observaciones']) ? $data['registros']['observaciones'] : '';

$producto       = isset($data['registros']['producto']) ? $data['registros']['producto'] : '-1';
$cantidad       = isset($data['registros']['cantidad']) ? $data['registros']['cantidad'] : '1';

$precio         = isset($data['registros']['precio']) ? $data['registros']['precio'] : '';
 */
$proveedores    = $data["proveedores"];
$productos      = $data["productos"];

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
                    <label for="proveedor" class="col-3 col-form-label">Proveedor</label> 

                    <div class="col-9">

                        <input class="form-control" id="proveedor" value="Cargando..." <?=$disabled?>>

                    </div>
                </div>

                <div class="form-group row">
                    <label for="fecha" class="col-3 col-form-label">Fecha</label> 
                    <div class="col-9">
                    <input id="fecha" name="fecha" type="date" class="form-control" <?=$disabled?>>
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
                    <th>Precio Unit.</th>
                    <th>Precio Total</th>
                    <th>Acciones</th>
                </thead>

                <tbody id="detalle-compra">

                </tbody>
            </table>
        </div>
    </div>      

    <div class="row w-75">
        <div class="col">
            Total: <span id="total-compra"></span>
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
                <button id="btn-guardar" class="btn btn-primary">Guardar Compra</button>                
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

                        <div class="form-group row">
                            <label for="precio" class="col-3 col-form-label">Precio Unit.</label> 
                            <div class="col-9">
                            <input id="precio" name="precio" type="number" class="form-control" <?=$disabled?> value="<?=$precio?>">
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

     <!-- Modal Primer Pago -->
     <div class="modal fade" id="modal-primer-pago" data-backdrop="static" data-keyboard="false" tabindex="-1" >
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 id="titulo-modal-agregar-producto" class="modal-title">¿Registrar primer pago?</h5>
                <button type="button" class="close" data-dismiss="modal" >
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-producto-detalle" method="post" class="col-12 col-sm-10 col-md-10">

                    <div class="col">

                        <div class="form-group row">
                            <label for="importe-primer-pago" class="col-4 col-form-label">Importe</label> 
                            <div class="col">
                                <input id="importe-primer-pago" name="importe-primer-pago" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="observaciones-primer-pago" class="col-4 col-form-label">Observaciones</label> 
                            <div class="col">
                                <textarea id="observaciones-primer-pago" name="observaciones-primer-pago" rows="5" class="form-control w-100"></textarea>
                            </div>
                        </div>

                    </div>

                </form>
            </div>
            <div class="modal-footer">                
                <button id="btn-aceptar-primer-pago" type="button" class="btn btn-primary">Si</button>
                <button id="btn-cancelar-primer-pago" type="button" class="btn btn-secondary">No</button>
            </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal Primer Pago-->

</div>
