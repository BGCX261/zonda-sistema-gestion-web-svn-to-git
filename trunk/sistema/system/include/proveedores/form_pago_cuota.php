<?php
    
    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/cuotas.php');
    include_once('include/compras/compras.php');
    include_once('include/configuracion/condiciones_venta.php');
    
    $cuotas = new Cuotas(new Compras());
    
    $monto_cuota = $cuotas->monto_cuota($_REQUEST['codigo']);
    
    include_once('include/proveedores/form_pago.php');

?>