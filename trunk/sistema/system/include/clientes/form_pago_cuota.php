<?php
    
    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/cuotas.php');
    include_once('include/ventas/ventas.php');
    include_once('include/configuracion/condiciones_venta.php');
    
    $cuotas = new Cuotas(new Ventas());
    
    $monto_cuota = $cuotas->monto_cuota($_REQUEST['codigo']);
    
    include_once('include/clientes/form_pago.php');

?>