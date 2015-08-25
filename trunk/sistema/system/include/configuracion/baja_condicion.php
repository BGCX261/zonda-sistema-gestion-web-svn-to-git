<?php
    include_once('include/table_handler.php');
    include_once('include/configuracion/condiciones_venta.php');
    
    $condiciones = new CondicionesVenta();
    
    $action_message = "Se ha borrado la condición de venta";
    
    if (!$condiciones->delete($_REQUEST['codigo'])) {
        $action_message = mysql_error();
    }
?>