<?php

    include("config/constantes.php");
    include('resumen_compra.php');
    if ( $data["compra"]["id_usuario"] == $_SESSION['usuario']['id']){
?>

<a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=pagos_compras&a=agregar&idCompra=<?=$data["compra"]["id"]?>">Nuevo</a>

<?php } ?>

<script>
    const idUsuarioCompra =<?=$data["compra"]["id_usuario"]?>;
</script>

<table id="tabla" class="display table" >
    <thead>
        <tr>
            <th>Id</th>            
            <th>Fecha</th>
            <th>Importe</th>  
            <th>Observaciones</th>  
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
            <td><?php echo $data["registros"][$i]["fecha"];?></td> 
            <td>$ <?php echo $data["registros"][$i]["importe_pagado"];?></td>   
            <td><?php echo $data["registros"][$i]["observaciones"];?></td>       
            <td></td> 
        <?php
        }?>
        </tr>
    </tbody>
</table>
