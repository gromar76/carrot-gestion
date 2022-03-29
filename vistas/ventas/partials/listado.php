<?php
//var_dump($data["registros"][0]["nombre"]);

include("config/constantes.php");

?>

<div class="row">
    <div class="col-1">
        <a class="btn btn-primary mb-3" href="<?=$URL_BASE?>/index.php?m=ventas&a=agregar">Nuevo</a>
    </div>
    <div class="col-1">
        <button id="btn-resumen" class="btn btn-secondary mb-3" data-toggle="modal" data-target="#modal-resumen-ventas">Resumen</button>
    </div>
</div>

<div class="row d-flex align-items-center p-2" style=" margin-bottom: 20px !important; background-color: #e9e5e5">

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


    <!-- FILTRO USUARIO REFACTOR HACER DINAMICO --> 
    <div class="col-1 ml-3">
        <span>Usuario</span>
        <select id="usuario-listado-venta">
            <option value="-1" <?= $data['filtroUsuario'] == -1 ? 'selected' : '' ?>>Todos</option>
            <option value="1" <?= $data['filtroUsuario'] == 1 ? 'selected' : '' ?>>Nicolas</option>
            <option value="2" <?= $data['filtroUsuario'] == 2 ? 'selected' : '' ?>>Marcelo</option>
        </select>
    </div>
    <!-- FIN FILTRO TIPO CLIENTE -->

    <button id="btn-aplicar-filtros" class="btn btn-secondary ml-2">Aplicar</button>
    <button id="btn-limpiar-filtros" class="btn btn-secondary ml-2">Limpiar</button>

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

<!-- MODAL DE RESUMEN -->
<div class="modal fade" id="modal-resumen-ventas" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Resumen de ventas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Producto</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                </tr>
                <tr>
                    <td>Producto</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Total</td>
                </tr>
            </tbody>
           
        </table>

        <ul>
            <li>Egreso: </li>
            <li>Total: </li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- FIN MODAL DE RESUMEN -->