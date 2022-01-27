<?php
    include_once('funciones/html.php');
    include("config/constantes.php");

//var_dump($data["registros"][0]["nombre"]);

    $clientesDe  = $data["clientesDe"];
    $usuario     = $data["usuario"];
    $usuarios    = $data["usuarios"];

?>


<div class="row">

    <div class="col">
        <a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=clientes&a=agregar">Nuevo</a> 
    </div> 
    <div class="col-3">
        <div class="row">
            <div class="col-4 text-right mr-1 mt-2">
                <label for="cliente-de-usuario">Clientes de</label>
            </div>
            <div class="col">
                <select class="form-control" id="cliente-de-usuario" name="cliente-de-usuario" >
                    <!-- REFACTOR CARGAR DINAMICAMENTE-->
                   <!--  <option value="-1">Ambos</option>
                    <option value="2" selected>Marcelo</option>
                    <option value="1">Nicolas</option> -->
                    <option value="-1">Ambos</option>

                    <?= dameOpcionesDelSelect($usuarios, $clientesDe);  ?>

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


