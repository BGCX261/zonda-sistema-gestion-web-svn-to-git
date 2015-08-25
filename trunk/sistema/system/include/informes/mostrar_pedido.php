<?php
    include ('conexion.php');
    include ('util.php');
    
    print '<h1>Pedido de cliente</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        print '<p class="parametros-informe" align="right">
                <button id="exportar_informe">Exportar</button>
                <button id="imprimir_informe">Imprimir</button>
            </p>';
    
    }
    
    $query1 = "
        SELECT
            LPAD(pedidos.codigo, 12, 0),
            DATE_FORMAT(pedidos.fecha, '%d/%m/%Y %H:%i:%S'),
            CONCAT_WS(' - ', clientes.codigo, clientes.razon),
            CONCAT('$', pedidos.monto)
        FROM
            pedidos,
            clientes
        WHERE
            pedidos.cliente = clientes.codigo
            AND
            pedidos.codigo = ".$_REQUEST['codigo'];
    
    $query2 = "
        SELECT
            LPAD(pedidos_detalle.articulo, 12, 0),
            articulos.descripcion,
            categorias.categoria, 
            pedidos_detalle.cantidad,
            CONCAT('$', pedidos_detalle.precio)
        FROM
            pedidos_detalle,
            pedidos,
            articulos,
            categorias 
        WHERE
            pedidos_detalle.pedido = pedidos.codigo
            AND 
            categorias.codigo = articulos.categoria 
            AND
            pedidos_detalle.articulo = articulos.codigo
            AND
            pedidos_detalle.pedido = pedidos.codigo
            AND
            pedidos.codigo = ".$_REQUEST['codigo'];
    
    $Etiquetas = array('Código de pedido', 'Fecha', 'Cliente', 'Monto');
    
    $NombreCampos = array('Código de artículo', 'Descripción', 'Categoría', 'Cantidad', 'Precio');
    
    $Alineacion = array('right', 'left', 'left', 'right', 'right');
    
    $AnchoCelda = array('20%', '30%', '20%', '15%', '15%');
    
    listadoDetalles($query1, $query2, $Etiquetas, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>