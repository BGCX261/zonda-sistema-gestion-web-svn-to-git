<?php

    include ('include/util.php');
    
    print '<h1>Listado de compras</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        include ('include/form_fechas.php');
    
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query = "
        SELECT
            compras.codigo
        FROM
            compras
        WHERE
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";
    
    $Registros = mysql_num_rows(mysql_query($query));
   
    include_once('include/cantidad_registros.php');
    
    $query1 = "
        SELECT
            LPAD(compras.codigo, 12, 0),
            compras.factura, 
            CONCAT_WS(' ', DATE_FORMAT(compras.fecha, '%d/%m/%Y'),
            DATE_FORMAT(compras.fecha, '%H:%i:%S')),
            proveedores.razon, 
            CONCAT('$', compras.monto) 
        FROM
            compras,
            proveedores 
        WHERE
            proveedores.codigo = compras.proveedor 
            AND 
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $query2 = "
        SELECT
            LPAD(compras_detalle.articulo, 12, 0),
            articulos.descripcion,
            SUM(compras_detalle.cantidad),
            SUM(compras_detalle.precio * compras_detalle.cantidad)  
        FROM
            compras_detalle,
            articulos 
        WHERE
            articulos.codigo = compras_detalle.articulo
            AND
            compras_detalle.compra = |*-*| 
        GROUP BY
            compras_detalle.articulo";
    
    $Etiquetas = array('Código de operación', 'Número de factura', 'Fecha', 'Proveedor', 'Monto');
    
    $NombreCampos = array('Código', 'Descripción', 'Cantidad', 'Total');
    
    $Alineacion = array('left', 'left', 'right', 'right');
    
    $AnchoCelda = array('20%', '30%', '30%', '20%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>