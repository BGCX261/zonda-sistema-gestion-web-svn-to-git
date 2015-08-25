<?php
    
    $form = $_REQUEST['form'];
    
    if (strpos($form, 'venta')) {
        include_once('include/ventas/baja_venta.php');
    }
    elseif (strpos($form, 'pedido')) {
        include_once('include/ventas/baja_pedido.php');
    }
    
?>