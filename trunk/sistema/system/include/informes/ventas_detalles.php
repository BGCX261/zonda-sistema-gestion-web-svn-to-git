<?php

    include ('include/util.php');
    
    print '<h1>Listado de ventas</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        include ('include/form_fechas.php');
    
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query = "
        SELECT
            ventas.codigo
        FROM
            ventas
        WHERE
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $query1 = "
        SELECT
            LPAD(ventas.codigo, 12, 0),
            ventas.factura, 
            CONCAT_WS(' ', DATE_FORMAT(ventas.fecha, '%d/%m/%Y'),
            DATE_FORMAT(ventas.fecha, '%H:%i:%S')),
            clientes.razon,
            ventas.monto 
        FROM
            ventas,
            clientes 
        WHERE
            clientes.codigo = ventas.cliente 
            AND 
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        ORDER BY 
            ventas.codigo";
    
    $query2 = "
        SELECT
            LPAD(ventas_detalle.articulo, 12, 0),
            articulos.descripcion,
            SUM(ventas_detalle.cantidad),
            SUM(ventas_detalle.precio * ventas_detalle.cantidad)  
        FROM
            ventas_detalle,
            articulos 
        WHERE
            articulos.codigo = ventas_detalle.articulo
            AND
            ventas_detalle.venta = |*-*| 
        GROUP BY
            ventas_detalle.articulo
        ORDER BY 
            ventas_detalle.articulo";
    
    $Etiquetas = array('Código de operación', 'Número de factura', 'Fecha', 'Cliente', 'Monto');
    
    $NombreCampos = array('Código', 'Descripción', 'Cantidad', 'Total');
    
    $Alineacion = array('left', 'left', 'right', 'right');
    
    $AnchoCelda = array('20%', '40%', '20%', '20%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>