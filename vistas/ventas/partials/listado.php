<?php
//var_dump($data["registros"][0]["nombre"]);

include("config/constantes.php");

?>

<div class="row">
    <div class="col-1">
        <a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=ventas&a=agregar">Nuevo</a>
    </div>
    </div>

<div class="row d-flex align-items-center" style="margin-bottom: 20px !important;">

    <!-- FILTRO CLIENTE -->


    <div class="col-5 mr-3">
        <span>Cliente</span>
        <input class="form-control w-100" id="filtro-cliente" value="Cargando..." >
    </div>

    <!-- FIN FILTRO CLIENTE -->

    <!-- FILTRO FECHA -->

    <div class="col-2">
        <span>Desde</span>
        <input id="filtro-desde" class="form-control" type="date" value="<?=$data['filtroDesde']?>">
    </div>


    <div class="col-2 ml-3">
        <span>Hasta</span>

        <input id="filtro-hasta" class="form-control" type="date" value="<?=$data['filtroHasta']?>">
    </div>

    <!-- FIN FILTRO FECHA -->

    <!-- FILTRO SOLO PENDIENTES -->
    <div class="col-1 ml-3">
        <label class="mt-5" for="filtro-solo-pendientes" >Sólo pendientes</label>

        <input  id="filtro-solo-pendientes"  type="checkbox" <?= $data['filtroSoloPendientes'] == 'true' ? 'checked' : '' ?> >
    </div>
    
    <!-- FIN FILTRO SOLO PENDIENTES -->

    <button id="btn-aplicar-filtros" class="btn btn-secondary ml-2 mt-4">Aplicar</button>
    <button id="btn-limpiar-filtros" class="btn btn-secondary ml-2 mt-4">Limpiar</button>

</div>




<table id="tabla" class="display table" >

    <thead>
        <tr>
            <th>Id</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Importe</th>  
            <th>Pagado</th>  
            <th>Pendiente</th>  
            <th>Usuario</th>
            <th>Usuario Id</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>        
        <?php

        $pendiente = 0;
        $totalPendiente = 0;
        $total = 0;
        $totalPagado = 0;


        for($i=0; $i<count($data["registros"]); $i++)
        {      
          $pendiente =  $data["registros"][$i]["importe"] -  $data["registros"][$i]["pagado"];
          $totalPendiente += $pendiente;
          $totalPagado += $data["registros"][$i]["pagado"];
          $total += $data["registros"][$i]["importe"];
      ?>
      <tr>
            <td><?php echo $data["registros"][$i]["id"];?></td>
            <td><?php echo $data["registros"][$i]["cliente"];?></td>
            <td><?php echo $data["registros"][$i]["fecha"];?></td> 
            <td>$ <?php echo $data["registros"][$i]["importe"];?></td>
            <td>$ <?php echo $data["registros"][$i]["pagado"];?></td>
            <td><?php echo $pendiente;?></td>
            <td><?php echo $data["registros"][$i]["usuario"];?></td>    
            <td><?php echo $data["registros"][$i]["id_usuario"];?></td>           
            <td></td> 
        <?php
        }?>
        </tr>
    </tbody>

     <?php
        $estiloPendiente = $pendiente > 0 ? 'color: red;' : 'color: black;';
    ?> 

</table>
 
<?php $estiloTotalPendiente = $totalPendiente > 0 ? 'color: red;' : 'color: black;'; ?>


<div class="row bg-light p-2" style="margin-bottom: 20px !important; margin-top: 20px !important;">
        <div class="col">
            Total: <b>$ <?=$total?></b>
        </div>

        <div class="col">
            Pagado: <b>$ <?=$totalPagado?></b>
        </div>
        
        <div class="col">
            Pendiente: <b style="<?=$estiloTotalPendiente?>">$ <?=$totalPendiente?></b>
        </div>
    </div>