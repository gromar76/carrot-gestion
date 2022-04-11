<?php

include("config/constantes.php");

?>

<a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=movimientos_depositos&a=agregar">Nuevo</a>

<table id="tabla" class="display table" >
    <thead>
        <tr>
            <th>Id</th>       
            <th>Fecha</th>
            <th>Origen</th>  
            <th>Destino</th> 
            <th>Detalle</th>  
            <th>Usuario</th> 
            <th>Por confirmar</th> 
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>        
        <?php

        for($i=0; $i<count($data["registros"]); $i++)
        {               
      ?>
        <tr>
            <td><?= $data["registros"][$i]["id"];?></td>
            <td><?= $data["registros"][$i]["fecha"];?></td>
            <td><?= $data["registros"][$i]["origen"];?></td> 
            <td><?= $data["registros"][$i]["destino"];?></td>
            <td><?= $data["registros"][$i]["detalle"];?></td> 
            <td><?= $data["registros"][$i]["usuario"];?></td>       
            <td><?= $data["registros"][$i]["por_confirmar"];?></td>        
            <td></td> 
        <?php
        }?>
        </tr>
    </tbody>
</table>

<!-- Modal Confirmaciones -->
<div class="modal fade" id="modal-confirmaciones" data-backdrop="static" data-keyboard="false" tabindex="-1" >
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 id="titulo-modal-agregar-producto" class="modal-title">Confirmaciones</h5>
            <button type="button" class="close" data-dismiss="modal" >
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Confirma</th>
                    </tr>
                </thead>

                <tbody id="body-confirmaciones"></tbody>
            </table>
        </div>
        <div class="modal-footer">                
            <button id="btn-guardar-confirmaciones" type="button" class="btn btn-primary">Aceptar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
        </div>
    </div>
</div>
<!-- Fin Modal Confirmaciones-->   