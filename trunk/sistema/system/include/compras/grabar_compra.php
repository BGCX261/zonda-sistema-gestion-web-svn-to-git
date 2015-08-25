<?php

    if (!isset($_SESSION['lista_articulos'])) {
        $action_message = "No hay artículos en la lista!";
        return;
    }
    
    if (!isset($_REQUEST['factura']) || $_REQUEST['factura'] < 0 || 
        !isset($_REQUEST['proveedor']) || $_REQUEST['proveedor'] < 1 || 
        !isset($_REQUEST['operacion']) || $_REQUEST['operacion'] < 1 || 
        !isset($_REQUEST['condicion']) || $_REQUEST['condicion'] < 1 || 
        !isset($_REQUEST['fondo']) || $_REQUEST['fondo'] < 1) {
        $action_message = "Debe ingresar todos los datos de la compra!";
        return;
    }
    
    /*
     * TRAER LOS DATOS DE LA CONDICION DE COMPRA:
     */
    $query = "
        SELECT 
            cuotas,
            plazo,
            interes
        FROM 
            condiciones_venta
        WHERE 
            codigo = ".$_REQUEST['condicion'];
    
    $result = mysql_query($query);
    
    if (!$result) {
        $action_message = mysql_error();
        return;
    }
    
    $row = mysql_fetch_array($result);
    
    $cuotas = $row[0];
    $plazo = $row[1];
    $interes = $row[2] / 100;
    $monto = $_SESSION['lista_articulos']->get_total() * (1 + $interes);
    
    /*
     * INGRESAR EL REGISTRO DE COMPRA:
     */
    $query = "
        INSERT INTO compras (
            factura,
            fecha,
            proveedor,
            fondo,
            condicion,
            monto,
            saldo
        ) VALUES (
            ".$_REQUEST['factura'].",
            now(),
            ".$_REQUEST['proveedor'].",
            ".$_REQUEST['fondo'].", 
            ".$_REQUEST['condicion'].", 
            ".$_SESSION['lista_articulos']->get_total().", ";
    
    if ($cuotas < 1) {
        $query .= "0";
    } 
    else {
        $query .= $monto;
    }
    
    $query .= ")";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * OBTENER EL ID DEL REGISTRO DE COMPRA:
     */
    $compra = mysql_insert_id();
    
    /*
     * INGRESAR TODOS LOS ARTICULOS EN EL DETALLE DE COMPRAS:
     */
    foreach ($_SESSION['lista_articulos']->get_items() as $articulo) {
        
        $query = "
            INSERT INTO compras_detalle (
                compra,
                articulo,
                precio,
                cantidad 
            ) VALUES (
                ".$compra.",
                ".$articulo['codigo'].",
                ".$articulo['precio'].",
                ".$articulo['cantidad']."
            )";
            
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
        
        $query = "
            UPDATE
                articulos
            SET
                existencia = (existencia + ".$articulo['cantidad'].")
            WHERE
                codigo = ".$articulo['codigo'];
        
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    /*
     * ACTUALIZAR EL MONTO DEL FONDO:
     */
    if ($cuotas < 1) {
        
        $query = "
            UPDATE
                fondos
            SET
                saldo = (saldo - ".$monto.")
            WHERE
                codigo = ".$_REQUEST['fondo'];
                
        $result = mysql_query($query);
        
        if (!$result) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    /*
     * ACTUALIZAR EL TOTAL DE LA CUENTA DEL PROVEEDOR:
     */
    $query = "
        UPDATE
            proveedores
        SET
            total = (total + ".$monto.")
        WHERE
            codigo = ".$_REQUEST['proveedor'];
            
    $result = mysql_query($query);
    
    if (!$result) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * ACTUALIZAR EL SALDO DE LA CUENTA DEL PROVEEDOR:
     */
    if ($cuotas > 0) {
    
        $query = "
            UPDATE
                proveedores
            SET
                saldo = (saldo + ".$monto.")
            WHERE
                codigo = ".$_REQUEST['proveedor'];
        
        $result = mysql_query($query);
        
        if (!$result) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    /*
     * SI SE ESTA COMPRANDO CON IVA:
     */
    $query = "SELECT iva FROM tipos_facturas WHERE codigo = ".$_REQUEST['operacion'];
            
    $result = mysql_query($query);
    
    if (!$result) {
        $action_message = mysql_error();
        return;
    }
    
    $iva = mysql_fetch_array($result);
    
    if ($iva[0] != 0) {
        
        $query = "
            INSERT INTO iva_compras (
                fecha,
                operacion,
                monto
            ) VALUES (
                now(),
                ".$compra.",
                ".$_SESSION['lista_articulos']->get_total_iva()."
            )";
        
        $result = mysql_query($query);
        
        if (!$result) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    $action_message = "Se ha grabado la compra!";
    
?>
