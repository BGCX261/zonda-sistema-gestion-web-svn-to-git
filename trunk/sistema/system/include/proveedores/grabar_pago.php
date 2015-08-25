<?php

    if (!isset($_REQUEST['proveedor']) || $_REQUEST['proveedor'] < 1 || 
        !isset($_REQUEST['codigo']) || $_REQUEST['codigo'] < 1 || 
        !isset($_REQUEST['monto']) || $_REQUEST['monto'] <= 0 || 
        !isset($_REQUEST['fondo']) || $_REQUEST['fondo'] < 1) {
        $action_message = "Debe ingresar todos los datos de la operación!";
        return;
    }

    include_once('include/sesion.php');
    
    $sesion = new Sesion();

    $query = "UPDATE compras SET saldo = (saldo - ".$_REQUEST['monto'].") WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $query = "UPDATE fondos SET saldo = (saldo - ".$_REQUEST['monto'].") WHERE codigo = ".$_REQUEST['fondo'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $query = "
        UPDATE
            proveedores
        SET
            saldo = (saldo - ".$_REQUEST['monto'].")
        WHERE
            codigo = ".$_REQUEST['proveedor'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
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
                ".$_REQUEST['proveedor'].",
                ".$sesion->get_user_id().",
                ".$_REQUEST['codigo'].",
                ".$_REQUEST['fondo'].",
                ".$_REQUEST['monto']."
            )";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha registrado el pago!";
    
?>