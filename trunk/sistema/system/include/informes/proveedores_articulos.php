<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de artículos comprados por proveedor</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
    
        include ('include/form_fechas.php');
        
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query1 = "
        SELECT DISTINCT
            LPAD(proveedores.codigo, 12, 0),
            proveedores.razon
        FROM
            proveedores,
            compras
        WHERE
            compras.proveedor = proveedores.codigo 
            AND
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";
    
    $query2 = "
        SELECT
            LPAD(articulos.codigo, 12, 0),
            articulos.descripcion,
            categorias.categoria, 
            SUM(compras_detalle.cantidad),
            SUM(compras_detalle.cantidad * compras_detalle.precio) 
        FROM
            compras_detalle,
            compras,
            articulos,
            categorias 
        WHERE
            compras_detalle.compra = compras.codigo
            AND 
            categorias.codigo = articulos.categoria 
            AND
            compras_detalle.articulo = articulos.codigo
            AND
            compras.proveedor = |*-*| 
            AND 
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY
            compras_detalle.articulo";
    
    $Registros = mysql_num_rows(mysql_query($query1));
    
    include_once('include/cantidad_registros.php');
    
    $Etiquetas = array('Código', 'Razón social');
    
    $NombreCampos = array('Código de artículo', 'Descripción', 'Categoría', 'Cantidad', 'Total');
    
    $Alineacion = array('right', 'left', 'left', 'right', 'right');
    
    $AnchoCelda = array('15%', '30%', '25%', '15%', '15%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>