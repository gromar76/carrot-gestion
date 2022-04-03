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