<?php
    include ('conexion.php');
    include ('util.php');
    
    print '<h1>Factura de cliente</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        print '<p class="parametros-informe" align="right">
                <button id="exportar_informe">Exportar</button>
                <button id="imprimir_informe">Imprimir</button>
            </p>';
    
    }
    
    $query1 = "
        SELECT
            LPAD(ventas.codigo, 12, 0),
            DATE_FORMAT(ventas.fecha, '%d/%m/%Y %H:%i:%S'),
            CONCAT_WS(' - ', clientes.codigo, clientes.razon),
            CONCAT('$', ventas.monto)
        FROM
            ventas,
            clientes
        WHERE
            ventas.cliente = clientes.codigo
            AND
            ventas.codigo = ".$_REQUEST['codigo'];
    
    $query2 = "
        SELECT
            LPAD(ventas_detalle.articulo, 12, 0),
            articulos.descripcion,
            categorias.categoria, 
            ventas_detalle.cantidad,
            CONCAT('$', ventas_detalle.precio),
            CONCAT('$', ventas_detalle.precio * ventas_detalle.cantidad)
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
            ventas.codigo = ".$_REQUEST['codigo'];
    
    $Etiquetas = array('Código de pedido', 'Fecha', 'Cliente', 'Monto');
    
    $NombreCampos = array('Código de artículo', 'Descripción', 'Categoría', 'Cantidad', 'Precio', 'Total');
    
    $Alineacion = array('left', 'left', 'left', 'right', 'right', 'right');
    
    $AnchoCelda = array('20%', '30%', '20%', '10%', '10%', '10%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>