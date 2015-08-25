<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de artículos comprados por clientes</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/form_fechas.php');
    
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query1 = "
        SELECT DISTINCT
            LPAD(clientes.codigo, 12, 0),
            clientes.razon
        FROM
            clientes,
            ventas
        WHERE
            ventas.cliente = clientes.codigo
            AND
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";
    
    $query2 = "
        SELECT
            categorias.categoria,
            SUM(ventas_detalle.cantidad),
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 
        FROM
            ventas_detalle,
            articulos,
            categorias,
            ventas 
        WHERE
            ventas_detalle.articulo = articulos.codigo
            AND
            articulos.categoria = categorias.codigo 
            AND
            ventas_detalle.venta IN (
                SELECT
                    codigo
                FROM
                    ventas
                WHERE
                    cliente = |*-*|
            )
            AND
            ventas_detalle.venta = ventas.codigo 
            AND 
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY
            categorias.categoria";
    
    $Registros = mysql_num_rows(mysql_query($query1));
    
    $Etiquetas = array('Código', 'Razón social');
    
    $NombreCampos = array('Categoría', 'Cantidad', 'Total');
    
    $Alineacion = array('left', 'right', 'right');
    
    $AnchoCelda = array('50%', '25%', '25%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>