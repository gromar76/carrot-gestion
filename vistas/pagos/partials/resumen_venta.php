<?php
    $pendiente = $data["venta"]["importe"] - $data["venta"]["pagado"];
    $estiloPendiente = $pendiente > 0 ? 'color: red;' : 'color: black;';
?>

<div class="row" style="margin-bottom: 20px !important;">
    
    <div class="col">
        Cliente: <b><?= $data["venta"]["cliente"] ?></b>
    </div>
    
    <div class="col">
        Fecha: <b><?= $data["venta"]["fecha"] ?></b>
    </div>

    <div class="col">
        Total: <b>$ <?=$data["venta"]["importe"] ?></b>
    </div>

    <div class="col">
        Pagado: <b>$ <?=  $data["venta"]["pagado"] ? $data["venta"]["pagado"] : 0 ?></b>
    </div>
    
    <div class="col">
        Pendiente: <b style="<?=$estiloPendiente?>">$ <?= $pendiente ?></b>
    </div>
</div>