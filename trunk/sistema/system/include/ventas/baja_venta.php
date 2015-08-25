<?php
    /*
     * EXTRAER EL REGISTRO DE LA VENTA:
     */
    $query = "SELECT 
            factura,
            fecha,
            cliente, 
            monto,
            saldo,
            fondo
        FROM
            ventas 
        WHERE
            codigo = ".$_REQUEST['codigo'];
    
    $result = mysql_query($query);
    
    if (!$result) {
        $action_message = mysql_error();
        return;
    }
    
    $row = mysql_fetch_array($result);
    
    /*
     * CARGAR EL REGISTRO EN LA TABLA DE FACTURAS ANULADAS:
     */
    $query = "INSERT INTO
        anuladas (
            factura,
            fecha,
            cliente,
            monto
        ) VALUES (
            '".$row[0]."',
            '".$row[1]."',
            ".$row[2].",
            ".$row[3]."
        )";
    
    $return = mysql_query($query);
    
    if (!$return) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * SI HAY UN SALDO DE FACTURA PENDIENTE, ACTUALIZAR EL REGISTRO DE CLIENTE:
     */
    if ($row[4] > 0) {
        $query = "UPDATE
                clientes
            SET
                saldo = saldo - ".$row[4].",
                total = total - ".$row[3]."
            WHERE
                codigo = ".$row[2];
        
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
    }
    
    /*
     * ACTUALIZAR EL SALDO DEL FONDO:
     */
    $query = "
        UPDATE
            fondos
        SET
            saldo = (saldo - ".($row[3] - $row[4]).")
        WHERE
            codigo = ".$row[5];
    
    $result = mysql_query($query);
    
    if (!$result) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * ACTUALIZAR EL STOCK DE ARTICULOS:
     */
    $query = "SELECT articulo, cantidad FROM ventas_detalle WHERE venta = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        $action_message = mysql_error();
        return;
    }
    
    while($art = mysql_fetch_array($result)) {
        $query = "UPDATE articulos SET existencia = (existencia + ".$art[1].") WHERE codigo = ".$art[0];
        
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
    }
    
    /*
     * BORRAR EL REGISTRO DE VENTA:
     */
    $query = "DELETE FROM ventas WHERE codigo = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * BORRAR EL DETALLE DE LA VENTA:
     */
    $query = "DELETE FROM ventas_detalle WHERE venta = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * ELIMINAR EL REGISTRO DE IVA:
     */
    $query = "DELETE FROM iva_ventas WHERE operacion = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha anulado la factura!";
    
?>