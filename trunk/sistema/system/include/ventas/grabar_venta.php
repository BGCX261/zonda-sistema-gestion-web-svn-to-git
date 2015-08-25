<?php

    if (!isset($_SESSION['lista_articulos'])) {
        $action_message = "No hay artículos en la lista!";
        return;
    }
    
    if (!isset($_REQUEST['cliente']) || $_REQUEST['cliente'] < 1 || 
        !isset($_REQUEST['operacion']) || $_REQUEST['operacion'] < 1 || 
        !isset($_REQUEST['condicion']) || $_REQUEST['condicion'] < 1 || 
        !isset($_REQUEST['fondo']) || $_REQUEST['fondo'] < 1) {
        $action_message = "Debe ingresar todos los datos de la venta!";
        return;
    }
    
    /*
     * TRAER LOS DATOS DE LA CONDICION DE VENTA:
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
     * INGRESAR EL REGISTRO DE VENTA:
     */
    $query = "
        INSERT INTO ventas (
            factura,
            fecha,
            cliente,
            fondo,
            condicion,
            monto,
            saldo
        ) VALUES (
            (SELECT actual FROM talonarios ORDER BY codigo DESC LIMIT 0,1),
            now(),
            ".$_REQUEST['cliente'].",
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
     * OBTENER EL ID DEL REGISTRO DE VENTA:
     */
    $venta = mysql_insert_id();
    
    /*
     * ACTUALIZAR EL NUMERO DEL TALONARIO:
     */
    $query = "
        UPDATE 
            talonarios
        SET
            actual = actual + 1
        WHERE 
            codigo = (SELECT MAX(codigo))";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * INGRESAR TODOS LOS ARTICULOS EN EL DETALLE DE VENTAS:
     */
    foreach ($_SESSION['lista_articulos']->get_items() as $articulo) {
        
        $query = "
            INSERT INTO ventas_detalle (
                venta,
                articulo,
                precio,
                cantidad 
            ) VALUES (
                ".$venta.",
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
                existencia = (existencia - ".$articulo['cantidad'].")
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
                saldo = (saldo + ".$monto.")
            WHERE
                codigo = ".$_REQUEST['fondo'];
        
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    /*
     * ACTUALIZAR EL TOTAL DE LA CUENTA DEL CLIENTE:
     */
    $query = "
        UPDATE
            clientes
        SET
            total = (total + ".$monto.")
        WHERE
            codigo = ".$_REQUEST['cliente'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * ACTUALIZAR EL SALDO DE LA CUENTA DEL CLIENTE:
     */
    if ($cuotas > 0) {
    
        $query = "
            UPDATE
                clientes
            SET
                saldo = (saldo + ".$monto.")
            WHERE
                codigo = ".$_REQUEST['cliente'];
        
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    /*
     * SI SE ESTA VENDIENDO CON IVA:
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
            INSERT INTO iva_ventas (
                fecha,
                operacion,
                monto
            ) VALUES (
                now(),
                ".$venta.",
                ".$_SESSION['lista_articulos']->get_total_iva()."
            )";
        
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    /*
     * SI LA VENTA ERA UN PEDIDO:
     */
    if (isset($_REQUEST['pedido']) && $_REQUEST['pedido'] != 0) {
        
        $query = "
            DELETE FROM
                pedidos
            WHERE
                codigo = ".$_REQUEST['pedido'];
        
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
        
        $query = "
            DELETE FROM
                pedidos_detalle
            WHERE
                pedido = ".$_REQUEST['pedido'];
        
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    $action_message = "Se ha grabado la venta!";

?>