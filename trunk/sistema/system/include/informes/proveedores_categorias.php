<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de artículos comprados por proveedores</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
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
            categorias.categoria,
            SUM(compras_detalle.cantidad),
            SUM(compras_detalle.cantidad * compras_detalle.precio) 
        FROM
            compras_detalle,
            articulos,
            categorias,
            compras 
        WHERE
            compras_detalle.articulo = articulos.codigo
            AND
            articulos.categoria = categorias.codigo 
            AND
            compras_detalle.compra IN (
                SELECT
                    codigo
                FROM
                    compras
                WHERE
                    proveedor = |*-*|
            )
            AND
            compras_detalle.compra = compras.codigo 
            AND 
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY
            categorias.categoria";
    
    $Registros = mysql_num_rows(mysql_query($query1));
    
    $Etiquetas = array('Código', 'Razón social');
    
    $NombreCampos = array('Categoría', 'Cantidad', 'Total');
    
    $Alineacion = array('left', 'right', 'right');
    
    $AnchoCelda = array('60%', '20%', '20%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion,$AnchoCelda);
    
?>