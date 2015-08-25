<?php

    $iva = 0;
    $discrimina = 0;
    
    if (isset($_REQUEST['iva'])) {
        if ($_REQUEST['iva'] == 1 || strtolower($_REQUEST['iva']) == 'true' || strtolower($_REQUEST['iva']) == 'on') {
            $iva = 1;
        }
    }
    if (isset($_REQUEST['discrimina'])) {
        if ($_REQUEST['discrimina'] == 1 || strtolower($_REQUEST['discrimina']) == 'true' || strtolower($_REQUEST['discrimina']) == 'on') {
            $discrimina = 1;
        }
    }
    
    include ('include/util.php');
    
    $query = "
        INSERT INTO facturas_tipo (
            descripcion,
            iva,
            discrimina
        )
        VALUES (
            '".verificar_sql($_REQUEST['descripcion'])."',
            ".$iva.",
            ".$discrimina."
        )";
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    if (!registrar_movimiento(28, mysql_insert_id())) {
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha agregado el tipo de factura!");
    
?>