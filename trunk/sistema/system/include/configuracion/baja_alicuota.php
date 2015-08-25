<?php
    include_once('include/table_handler.php');
    include_once('include/configuracion/alicuotas.php');
    
    $alicuotas = new Alicuotas();
    
    $action_message = "Se ha eliminado la alícuota";
    
    if (!$alicuotas->delete($_REQUEST['codigo'])) {
        $action_message = mysql_error();
    }
    
?>