<?php
    include_once('funciones/html.php');
    include("config/constantes.php");

//var_dump($data["registros"][0]["nombre"]);

    $clientesDe  = $data["clientesDe"];
    $actividad   = $data["actividad"];

    $usuario     = $data["usuario"];
    $usuarios    = $data["usuarios"];

    $actividades =  [ 
                        [ "id" => "ambos", "nombre" => "Ambos"], 
                        [ "id" => "padel", "nombre" => "Padel"],
                        [ "id" => "tenis", "nombre" => "Tenis"]
                    ];
?>


<div class="row">

    <div class="col">
        <a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=clientes&a=agregar">Nuevo</a> 
    </div> 
    <div class="col-4">
        <div class="row">
            <div class="text-right mr-1 mt-2 d-inline-flex">
                <label class="mx-2"  for="cliente-de-usuario">Clientes de</label>
           
                <select  class="form-control" id="cliente-de-usuario" name="cliente-de-usuario" >
                    <option value="-1">Ambos</option>

                    <?= dameOpcionesDelSelect($usuarios, $clientesDe);  ?>
                </select>
                    
                <label class="mx-2" for="cliente-de-usuario">Actividad</label>
     
                <select  class="form-control" id="actividad" name="actividad" >
                    <?= dameOpcionesDelSelect($actividades, $actividad);  ?>
                </select>
            </div>
        </div>
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


