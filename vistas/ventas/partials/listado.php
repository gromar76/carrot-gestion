<?php
//var_dump($data["registros"][0]["nombre"]);

include("config/constantes.php");

?>

<a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=ventas&a=agregar">Nuevo</a>

<table id="tabla" class="display table" >
    <thead>
        <tr>
            <th>Id</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Importe</th>  
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
             <td><?php echo $data["registros"][$i]["id"];?></td>
            <td><?php echo $data["registros"][$i]["cliente"];?></td>
            <td><?php echo $data["registros"][$i]["fecha"];?></td> 
            <td><?php echo $data["registros"][$i]["importe"];?></td>
            <td><?php echo $data["registros"][$i]["usuario"];?></td>             
            <td></td>
        <?php
        }?>
        </tr>
    </tbody>
</table>