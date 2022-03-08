<?php
    $pendiente = $data["compra"]["importe_total"] - $data["compra"]["importe_pagado"];
    $estiloPendiente = $pendiente > 0 ? 'color: red;' : 'color: black;';
?>

<div class="row" style="margin-bottom: 20px !important;">
    
    <div class="col">
        Cliente: <b><?= $data["compra"]["proveedor"] ?></b>
    </div>
    
    <div class="col">
        Fecha: <b><?= $data["compra"]["fecha"] ?></b>
    </div>

    <div class="col">
        Total: <b>$ <?=$data["compra"]["importe_total"] ?></b>
    </div>

    <div class="col">
        Pagado: <b>$ <?=  $data["compra"]["importe_pagado"] ? $data["compra"]["importe_pagado"] : 0 ?></b>
    </div>
    
    <div class="col">
        Pendiente: <b style="<?=$estiloPendiente?>">$ <?= $pendiente ?></b>
    </div>
</div>