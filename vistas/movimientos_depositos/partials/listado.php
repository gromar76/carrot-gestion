<?php

include("config/constantes.php");

?>

<a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=movimientos_depositos&a=agregar">Nuevo</a>

<table id="tabla" class="display table" >
    <thead>
        <tr>       
            <th>Fecha</th>
            <th>Origen</th>  
            <th>Destino</th> 
            <th>Detalle</th>  
            <th>Usuario</th> 
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>        
        <?php

        for($i=0; $i<count($data["registros"]); $i++)
        {               
      ?>
        <tr>
            <td><?= $data["registros"][$i]["fecha"];?></td>
            <td><?= $data["registros"][$i]["origen"];?></td> 
            <td><?= $data["registros"][$i]["destino"];?></td>
            <td><?= $data["registros"][$i]["detalle"];?></td> 
            <td><?= $data["registros"][$i]["usuario"];?></td>           
            <td></td> 
        <?php
        }?>
        </tr>
    </tbody>
</table>