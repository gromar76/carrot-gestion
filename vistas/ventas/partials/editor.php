<?php

include 'funciones/html.php';

// este archivo debe manejar el AGREGAR,VER Y EDITAR ----> CLIENTE
// si la accion es editar o ver, guardo en la variable el dato, sino pongo espacio vacio porque voy a dar de alta

// si existe registros nombre, entonces a $nombre ponele $data['registros']['nombre'], sino ponele ''

$cliente        = isset($data['registros']['cliente']) ? $data['registros']['cliente'] : '';
$fecha          = isset($data['registros']['fecha'])  ? $data['registros']['fecha'] : '';
$observaciones  = isset($data['registros']['observaciones']) ? $data['registros']['observaciones'] : '';

$producto       = isset($data['registros']['producto']) ? $data['registros']['producto'] : '-1';
$cantidad       = isset($data['registros']['cantidad']) ? $data['registros']['cantidad'] : '1';

$precio         = isset($data['registros']['precio']) ? $data['registros']['precio'] : '';

$clientes       = $data["clientes"];
$productos      = $data["productos"];

/*
$telefono2      = isset($data['registros']['telefono2']) ? $data['registros']['telefono2'] : '';
$email          = isset($data['registros']['email']) ? $data['registros']['email'] : '';
$esClienteDe    = isset($data['registros']['es_cliente_de']) ? $data['registros']['es_cliente_de'] : '';  //dio de alta marcelo o nicolas   esto vendra x la cookie luego del logueo
$esDistribuidor = isset($data['registros']['es_distribuidor']) ? $data['registros']['es_distribuidor'] : 0;  // 0 no , 1 si
$domicilio      = isset($data['registros']['domicilio']) ? $data['registros']['domicilio'] : '';
$cPostal        = isset($data['registros']['cpostal']) ? $data['registros']['cpostal'] : '';
$pais           = isset($data['registros']['id_pais']) ? $data['registros']['id_pais'] : 1; //ARGENTINA
$provincia      = isset($data['registros']['id_provincia']) ? $data['registros']['id_provincia'] : -1;
$localidad      = isset($data['registros']['id_localidad']) ? $data['registros']['id_localidad'] : -1;
$paginaWeb      = isset($data['registros']['paginaweb']) ? $data['registros']['paginaweb'] : '';
$instagram      = isset($data['registros']['instagram']) ? $data['registros']['instagram'] : '';
$facebook       = isset($data['registros']['facebook']) ? $data['registros']['facebook'] : '';
 */

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
                    <label for="cliente" class="col-3 col-form-label">Cliente</label> 
                    <div class="col-9">
                    <select id="cliente" name="cliente" class="custom-select" <?=$disabled?> value="<?=$cliente?>">
                        <?= dameOpcionesDelSelect($clientes); ?>
                    </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="fecha" class="col-3 col-form-label">Fecha</label> 
                    <div class="col-9">
                    <input id="fecha" name="fecha" type="date" class="form-control" <?=$disabled?> value="<?=$fecha?>">
                    </div>
                </div>
            </div>
            

        
        </form>
    </div>

    <div class="row w-75">
        <div class="col">
            <button id="btn-modal-agregar-producto" class="btn btn-primary" >Agregar producto</button>
        </div>
    </div>
    
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

                <tbody id="detalle-venta">

                </tbody>
            </table>
        </div>
    </div>      

    <div class="row w-75">
        <div class="col">
            Total: <span id="total-factura"></span>
        </div>
    </div>
    
    <div class="row w-100">
        <div class="col ml-4">
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" class="form-control" <?php echo $disabled?> id="observaciones" rows="5"><?=$observaciones?></textarea>
            </div>
        </div>
    </div>
        
    <div class="form-group row w-75">
        <div class="col text-center">                
            <?php 
                // si la accion es distinto de VER es porque estoy haciendo un alta o modificacion
                // entonces tiene que tener el boton de GUARDAR
                if ( $accion != 'ver' ){ ?>
                <button id="btn-guardar" class="btn btn-primary">Guardar</button>                
            <?php }?>

            <input id="btn-atras" class="btn btn-primary" type="reset" value= "<?= $accion == 'ver' ? 'Volver' : 'Cancelar' ?>" >
        </div>            
    </div>



    <!-- Modal -->
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
                            <label for="cantidad" class="col-3 col-form-label">cantidad</label> 
                            <div class="col-9">
                            <input id="cantidad" name="cantidad" type="number" class="form-control" <?=$disabled?> value="<?=$cantidad?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="precio" class="col-3 col-form-label">precio</label> 
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
    <!-- Fin Modal -->

</div>