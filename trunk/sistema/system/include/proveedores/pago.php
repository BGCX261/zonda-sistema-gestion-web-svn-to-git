<?php

    include_once("include/util.php");
    
    $query = "UPDATE compras SET saldo = (saldo - ".$_REQUEST['pago'].") WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    $query = "UPDATE fondos SET saldo = (saldo - ".$_REQUEST['pago'].") WHERE codigo = ".$_REQUEST['fondo'];
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    $query = "
        UPDATE
            proveedores
        SET
            saldo = (saldo - ".$_REQUEST['pago'].")
        WHERE
            codigo = (
                SELECT proveedor FROM compras WHERE codigo = ".$_REQUEST['codigo']."
            )";
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    $query = "INSERT INTO pagos (
                fecha, 
                proveedor, 
                usuario, 
                operacion, 
                fondo, 
                monto
            ) VALUES (
                NOW(),
                (
                    SELECT proveedor FROM compras WHERE codigo = ".$_REQUEST['codigo']."
                ),
                ".$_COOKIE['usuario'].",
                ".$_REQUEST['codigo'].",
                ".$_REQUEST['fondo'].",
                ".$_REQUEST['pago']."
            )";
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    if (!registrar_movimiento(5, $_REQUEST['codigo'])) {
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha registrado el pago!");
    
?>