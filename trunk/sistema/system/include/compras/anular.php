<?php

    include_once("include/util.php");
    
    /*
     * EXTRAER EL REGISTRO DE LA FACTURA:
     */
    $query = "SELECT 
            codigo,
            factura,
            fecha,
            proveedor, 
            fondo,
            monto,
            saldo
        FROM
            compras 
        WHERE
            codigo = ".$_REQUEST['codigo'];
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    $Registro = mysql_fetch_array($Result);
    
    /*
     * SI HAY UN SALDO DE FACTURA PENDIENTE, ACTUALIZAR EL REGISTRO DE PROVEEDOR:
     */
    if ($Registro[5] > 0) {
        $query = "UPDATE
                proveedores
            SET
                saldo = (saldo - ".$Registro[6]."),
                total = (total - ".$Registro[5].")
            WHERE
                codigo = ".$Registro[3];
        
        if (!mysql_query($query)) {
            sql_error_msg();
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
            saldo = (saldo + ".($Registro[5] - $Registro[6]).")
        WHERE
            codigo = ".$Registro[4];
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    /*
     * BORRAR EL REGISTRO DE COMPRA:
     */
    $query = "DELETE FROM compras WHERE codigo = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        sql_error_msg();
        return;
    }
    
    /*
     * ACTUALIZAR EL STOCK DE ARTICULOS:
     */
    $query = "SELECT articulo, cantidad FROM ventas_detalle WHERE venta = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        sql_error_msg();
        return;
    }
    
    while($Row = mysql_fetch_array($Result)) {
        $query = "UPDATE articulos SET existencia = (existencia - ".$Row[1].") WHERE codigo = ".$Row[0];
        
        if (!mysql_query($query)) {
            sql_error_msg();
            return;
        }
    }
    
    /*
     * ELIMINAR EL DETALLE DE LAS COMPRAS:
     */
    $query = "DELETE FROM compras_detalle WHERE compra = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        sql_error_msg();
        return;
    }
    
    /*
     * ELIMINAR EL REGISTRO DE IVA:
     */
    $query = "DELETE FROM iva_compras WHERE operacion = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        sql_error_msg();
        return;
    }
    
    /*
     * AGREGAR LA OPERACION EN LOS MOVIMIENTOS:
     */
    if (!registrar_movimiento(58, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha anulado la compra!");
    
?>