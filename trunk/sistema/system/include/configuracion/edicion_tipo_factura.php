<?php
    
    $iva = 0;
    $discrimina = 0;
    
    if (isset($_REQUEST['iva'])) {
        if ($_REQUEST['iva'] == 1 || strtolower($_REQUEST['iva']) == 'true' || strtolower($_REQUEST['iva']) == 'on' || strtolower($_REQUEST['iva']) == 'checked') {
            $iva = 1;
        }
    }
    if (isset($_REQUEST['discrimina'])) {
        if ($_REQUEST['discrimina'] == 1 || strtolower($_REQUEST['discrimina']) == 'true' || strtolower($_REQUEST['discrimina']) == 'on' || strtolower($_REQUEST['discrimina']) == 'checked') {
            $discrimina = 1;
        }
    }

    include ('include/util.php');
    
    $query = "
        UPDATE
            facturas_tipo
        SET
            descripcion = '".verificar_sql($_REQUEST['descripcion'])."',
            iva = ".$iva.",
            discrimina = ".$discrimina."
        WHERE
            codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
        
    if (!registrar_movimiento(29, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha editado el tipo de factura!");
    
?>