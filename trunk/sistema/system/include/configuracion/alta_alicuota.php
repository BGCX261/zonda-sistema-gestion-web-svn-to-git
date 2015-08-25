<?php
    include_once('include/table_handler.php');
    include_once('include/configuracion/alicuotas.php');
    
    $alicuotas = new Alicuotas();
    
    $action_message = "Se ha agregado la alícuota";
    
    if (!$alicuotas->add($_REQUEST['codigo'], $_REQUEST['descripcion'], $_REQUEST['alicuota'])) {
        $action_message = mysql_error();
    }
?>