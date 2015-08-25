<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de artículos comprados por cliente</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
        
        include ('include/botones_informe.php');
    
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
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            ";
    
    $query2 = "
        SELECT
            LPAD(articulos.codigo, 12, 0),
            articulos.descripcion,
            categorias.categoria, 
            SUM(ventas_detalle.cantidad),
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 
        FROM
            ventas_detalle,
            ventas,
            articulos,
            categorias 
        WHERE
            ventas_detalle.venta = ventas.codigo
            AND 
            categorias.codigo = articulos.categoria 
            AND
            ventas_detalle.articulo = articulos.codigo
            AND
            ventas.cliente = |*-*| 
            AND 
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY
            ventas_detalle.articulo";
    
    $Registros = mysql_num_rows(mysql_query($query1));
    
    include_once('include/cantidad_registros.php');
    
    $Etiquetas = array('Código', 'Razón social');
    
    $NombreCampos = array('Código de artículo', 'Descripción', 'Categoría', 'Cantidad', 'Total');
    
    $Alineacion = array('left', 'left', 'left', 'right', 'right');
    
    $AnchoCelda = array('20%', '30%', '20%', '15%', '15%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>