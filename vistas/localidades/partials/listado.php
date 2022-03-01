<?php
//var_dump($data["registros"][0]["nombre"]);
?>

<table id="tabla" class="display" style="width:80%">
    <thead>
        <tr>
            <th>Codigo</th>
            <th>Nombre Localidad</th>
            <th>Provincia</th>
            <th>Pais</th>
            <th>Acciones</th>         
        </tr>
    </thead>
    <tbody>        
            <?php
        for($i=0; $i<count($data["registros"]); $i++)
      {      
      ?>
      <tr>
            <td><?php echo $data["registros"][$i]["idLocalidad"];?></td>
            <td><?php echo $data["registros"][$i]["nomLocalidad"];?></td>
            <td><?php echo $data["registros"][$i]["nomProvincia"];?></td>
            <td><?php echo $data["registros"][$i]["nomPais"];?></td>
            <td></td>
        <?php
        }?>
        </tr>
    </tbody>
</table>
