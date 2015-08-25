<?php
    include ('conexion.php');
    include ('util.php');
    
    print '<h1>Factura de proveedor</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        print '<p class="parametros-informe" align="right">
                <button id="exportar_informe">Exportar</button>
                <button id="imprimir_informe">Imprimir</button>
            </p>';
    
    }
    
    $query1 = "
        SELECT
            LPAD(compras.codigo, 12, 0),
            DATE_FORMAT(compras.fecha, '%d/%m/%Y %H:%i:%S'),
            CONCAT_WS(' - ', proveedores.codigo, proveedores.razon),
            CONCAT('$', compras.monto)
        FROM
            compras,
            proveedores
        WHERE
            compras.proveedor = proveedores.codigo
            AND
            compras.codigo = ".$_REQUEST['codigo'];
    
    $query2 = "
        SELECT
            LPAD(compras_detalle.articulo, 12, 0),
            articulos.descripcion,
            categorias.categoria, 
            compras_detalle.cantidad,
            CONCAT('$', compras_detalle.precio),
            CONCAT('$', compras_detalle.precio * compras_detalle.cantidad)
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
            compras.codigo = ".$_REQUEST['codigo'];
    
    $Etiquetas = array('Código de pedido', 'Fecha', 'Cliente', 'Monto');
    
    $NombreCampos = array('Código de artículo', 'Descripción', 'Categoría', 'Cantidad', 'Precio', 'Total');
    
    $Alineacion = array('left', 'left', 'left', 'right', 'right', 'right');
    
    $AnchoCelda = array('20%', '30%', '20%', '10%', '10%', '10%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>