<?php
    include_once('include/table_handler.php');
    include_once('include/configuracion/condiciones_venta.php');
    
    $condiciones = new CondicionesVenta();
    
    $action_message = "Se ha agregado la condición de venta";
    
    if (!$condiciones->add($_REQUEST['codigo'], $_REQUEST['descripcion'], $_REQUEST['cuotas'], $_REQUEST['plazo'], $_REQUEST['intervalo'], $_REQUEST['interes'])) {
        $action_message = mysql_error();
    }
?>