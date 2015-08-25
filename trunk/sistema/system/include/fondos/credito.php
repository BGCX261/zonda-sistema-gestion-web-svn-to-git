<?php

    include_once('include/util.php');
    
    $query = "
        INSERT INTO fondos_creditos (
            fecha,
            fondo,
            monto,
            concepto
        )
        VALUES (
            now(),
            ".$_REQUEST['fondo'].",
            ".$_REQUEST['monto'].",
            '".verificar_sql($_REQUEST['concepto'])."'
        )";
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    $Codigo = mysql_insert_id();
    
    $query = "
        UPDATE
            fondos
        SET
            saldo = saldo + ".$_REQUEST['monto']."
        WHERE
            codigo = ".$_REQUEST['fondo'] ;
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    /*
     * AGREGAR LA OPERACION EN LOS MOVIMIENTOS:
     */
    if (!registrar_movimiento(3, $Codigo, $_REQUEST['monto'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha acreditado el monto al fondo!");
    
?>