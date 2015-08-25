<?php

    include_once('../conexion.php');
    include_once('../formatter.php');
    include_once('../table_handler.php');
    include_once('../detalle_factura.php');
    include_once('../detalle_pedido.php');
    include_once('../articulos/articulos.php');
    include_once('../clientes/clientes.php');
    include_once('../ventas/pedidos.php');
    include_once('../ventas/pedidos_detalle.php');
    
    Conexion::conectar();
    
    $pedidos = new Pedidos();
    $pedidos_detalle = new PedidosDetalle($_REQUEST['pedido']);
    
    $detalle = new DetallePedido($_REQUEST['pedido'], $pedidos, $pedidos_detalle);
    $detalle->mostrar_detalle();

?>