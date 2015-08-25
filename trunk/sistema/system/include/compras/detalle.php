<?php

    include_once('../conexion.php');
    include_once('../formatter.php');
    include_once('../table_handler.php');
    include_once('../detalle_factura.php');
    include_once('../detalle_venta.php');
    include_once('../articulos/articulos.php');
    include_once('../compras/compras.php');
    include_once('../compras/compras_detalle.php');
    
    Conexion::conectar();
    
    $compras = new Compras();
    $compras_detalle = new ComprasDetalle($_REQUEST['compra']);
    
    $detalle = new DetalleVenta($_REQUEST['compra'], $compras, $compras_detalle);
    $detalle->mostrar_detalle();

?>