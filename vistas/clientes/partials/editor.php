<?php
// este archivo debe manejar el AGREGAR,VER Y EDITAR ----> CLIENTE

//si la accion es EDITAR O VER debo mostrar los valores, solo no muestro cuando es alta
$nombre         = $accion != 'agregar' ? $data['registros']['nombre'] : '';
$apellido       = $accion != 'agregar' ? $data['registros']['apellido'] : '';
$dni            = $accion != 'agregar' ? $data['registros']['dni'] : '';
$whatsapp       = $accion != 'agregar' ? $data['registros']['whatsapp'] : '';
$telefono2      = $accion != 'agregar' ? $data['registros']['telefono2'] : '';
$email          = $accion != 'agregar' ? $data['registros']['email'] : '';
$esClienteDe    = $accion != 'agregar' ? $data['registros']['es_cliente_de'] : '';  //dio de alta marcelo o nicolas   esto vendra x la cookie luego del logueo
$esDistribuidor = $accion != 'agregar' ? $data['registros']['es_distribuidor'] : '';  // 0 no , 1 si
$domicilio      = $accion != 'agregar' ? $data['registros']['domicilio'] : '';
$cPostal        = $accion != 'agregar' ? $data['registros']['cpostal'] : '';
$pais           = $accion != 'agregar' ? $data['registros']['id_pais'] : 1; //ARGENTINA
$provincia      = $accion != 'agregar' ? $data['registros']['id_provincia'] : -1;
$localidad      = $accion != 'agregar' ? $data['registros']['id_localidad'] : -1;
$paginaWeb      = $accion != 'agregar' ? $data['registros']['paginaweb'] : '';
$instagram      = $accion != 'agregar' ? $data['registros']['instagram'] : '';
$facebook       = $accion != 'agregar' ? $data['registros']['facebook'] : '';
$observaciones  = $accion != 'agregar' ? $data['registros']['observaciones'] : '';

// si la accion es VER entonces disabled esta vacio
$disabled =  $accion == 'ver' ? "disabled" : ""; 

// la variable $accion viene con agregar, editar, ver
//echo $accion;
?>
<div class="row d-flex justify-content-center">

    <form method="post" action="index.php?m=clientes&a=<?= isset($data["registros"]["id"]) ? "editar&id=" . $data['registros']['id'] : "agregar" ?>"
        class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-4">

        <div class="form-group row">
            <label for="nombre" class="col-3 col-form-label">Nombre</label> 
            <div class="col-9">
            <input id="nombre" name="nombre" type="text" class="form-control" <?=$disabled?>  value="<?=$nombre?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="apellido" class="col-3 col-form-label">Apellido</label> 
            <div class="col-9">
            <input id="apellido" name="apellido" type="text" class="form-control" <?=$disabled?> value="<?=$apellido?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="dni" class="col-3 col-form-label">DNI</label> 
            <div class="col-9">
            <input id="dni" name="dni" type="text" class="form-control" <?=$disabled?> value="<?=$dni?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="whatsApp" class="col-3 col-form-label">WhatsApp</label> 
            <div class="col-9">
            <input id="whatsApp" name="whatsapp" type="text" class="form-control" <?=$disabled?> value="<?=$whatsapp?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="telefono2" class="col-3 col-form-label">Telefono (2)</label> 
            <div class="col-9">
            <input id="telefono2" name="telefono2" type="text" class="form-control" <?=$disabled?> value="<?=$telefono2?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-3 col-form-label">Email</label> 
            <div class="col-9">
            <input id="email" name="email" type="text" class="form-control" <?=$disabled?> value="<?=$email?>">
            </div>
        </div>                
        <div class="form-group row">
            <label for="es_cliente_de" class="col-3 col-form-label">Es cliente de </label> 
            <div class="col-9">
            <select id="es_cliente_de" name="es_cliente_de" class="custom-select" <?=$disabled?> value="<?=$esClienteDe?>">
                <option value="padel" <?=$esClienteDe == 'padel' ? 'selected' : ''?> >Padel</option>
                <option value="tenis" <?=$esClienteDe == 'tenis' ? 'selected' : ''?> >Tenis</option>
                <option value="ambos" <?=$esClienteDe == 'ambos' ? 'selected' : ''?> >Ambos</option>
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="distribuidor" class="col-3 col-form-label">Distribuidor?</label>   
            <div class="col-9">     
                <select id="distribuidor" name="es_distribuidor" class="custom-select" <?=$disabled?> >
                    <option value="1" <?=$esDistribuidor == 1 ? 'selected' : ''?> >NO</option>
                    <option value="2" <?=$esDistribuidor == 2 ? 'selected' : ''?> >SI</option>
                </select>   
</div>     
        </div>        
        <div class="form-group row">
            <label for="domicilio" class="col-3 col-form-label">Domicilio</label> 
            <div class="col-9">
            <input id="domicilio" name="domicilio" type="text" class="form-control" <?=$disabled?> value="<?=$domicilio?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="cpostal" class="col-3 col-form-label">C. Postal</label> 
            <div class="col-9">
            <input id="cpostal" name="cpostal" type="text" class="form-control" <?=$disabled?> value="<?=$cPostal?>">
            </div>
        </div>
        <div class="form-group row">            
            <label for="pais" class="col-3 col-form-label">Pais</label> 
            <div class="col-9">
            <select id="pais" name="pais" data-id-original="<?=$pais?>" class="custom-select" <?=$disabled?>></select>
            </div>
        </div>
        <div class="form-group row">
            <label for="provincia" class="col-3 col-form-label">Provincia</label> 
            <div class="col-9">
            <select id="provincia" data-id-original="<?=$provincia?>" name="provincia" class="custom-select" <?=$disabled?>></select>
            </div>            
        </div>
        <div class="form-group row">
            <label for="localidad" class="col-3 col-form-label">Localidad</label> 
            <div class="col-9">
            <select id="localidad" data-id-original="<?=$localidad?>" name="id_localidad" class="custom-select" <?=$disabled?>>               
            </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="paginaweb" class="col-3 col-form-label">Pagina Web</label> 
            <div class="col-9">
            <input id="paginaweb" name="paginaweb" type="text" class="form-control" <?=$disabled?> value="<?=$paginaWeb?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Instagram" class="col-3 col-form-label">Instagram</label> 
            <div class="col-9">
            <input id="instagram" name="instagram" type="text" class="form-control" <?=$disabled?> value="<?=$instagram?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="Facebook" class="col-3 col-form-label">Facebook</label> 
            <div class="col-9">
            <input id="facebook" name="facebook" type="text" class="form-control" <?=$disabled?> value="<?=$facebook?>">
            </div>
        </div>              
        <div class="form-group">
            <label for="observaciones">Observaciones</label>
            <textarea name="observaciones" class="form-control" <?php echo $disabled?> id="observaciones" rows="5"><?=$observaciones?></textarea>
            <!-- <textarea class="form-control" < ?= $disabled?> id="observaciones" rows="5"></textarea> -->
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