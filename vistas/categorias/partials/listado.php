<?php
//var_dump($data["registros"][0]["nombre"]);
?>

<a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=categorias&a=agregar">Nuevo</a>

<table id="tabla" class="display table">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Nombre</th>   
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
            <td><?php echo $data["registros"][$i]["nombre"];?></td>     
            <td></td>     
        <?php
        }?>
        </tr>
    </tbody>
</table>