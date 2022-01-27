<?php
    include("config/constantes.php");

//var_dump($data["registros"][0]["nombre"]);
?>

<a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=clientes&a=agregar">Nuevo</a>

<div class="container">
    <div class="col-3 row d-flex justify-content-center">
            <select id="clienteDeUsuario" name="clienteDeUsuario" class="custom-select">
                <option value="3" selected>Ambos</option>
                <option value="2">Marcelo</option>
                <option value="1">Nicolas</option>
            </select>
    </div>
</div>

<table id="tabla" class="display table" >
    <thead>
        <tr>
            <th>Codigo</th>            
            <th>Nombre</th>
            <th>whatsapp</th>            
            <th>Provincia</th>
            <th>Localidad</th>
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
            <td><?php echo $data["registros"][$i]["nombre_completo"]?></td>            
            <td><?php echo $data["registros"][$i]["whatsapp"];?></td>
            <td><?php echo $data["registros"][$i]["id_provincia"];?></td>
            <td><?php echo $data["registros"][$i]["id_localidad"];?></td>
            <td></td>
        <?php
        }?>
        </tr>
    </tbody>
</table>


