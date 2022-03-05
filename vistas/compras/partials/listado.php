<?php
//var_dump($data["registros"][0]["nombre"]);

include("config/constantes.php");

?>

<a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=compras&a=agregar">Nuevo</a>

<table id="tabla" class="display table" >
    <thead>
        <tr>
            <th>Id</th>
            <th>Proveedor</th>
            <th>Fecha</th>
            <th>Importe</th>  
            <th>Pagado</th>  
            <th>Pendiente</th>             
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>        
        <?php


        for($i=0; $i<count($data["registros"]); $i++)
        {      
          $pendiente =  $data["registros"][$i]["importe_total"] -  $data["registros"][$i]["importe_pagado"];
      ?>
      <tr>
             <td><?php echo $data["registros"][$i]["id"];?></td>
            <td><?php echo $data["registros"][$i]["nombre_empresa"];?></td>
            <td><?php echo $data["registros"][$i]["fecha"];?></td> 
            <td>$ <?php echo $data["registros"][$i]["importe_total"];?></td>
            <td>$ <?php echo $data["registros"][$i]["importe_pagado"];?></td>
            <td><?php echo $pendiente;?></td>               
            <td></td> 
        <?php
        }?>
        </tr>
    </tbody>
</table>