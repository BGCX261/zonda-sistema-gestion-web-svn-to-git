<?php

    include_once('../conexion.php');
    include_once('../formatter.php');
    include_once('../table_handler.php');
    include_once('../detalle_factura.php');
    include_once('../detalle_venta.php');
    include_once('../articulos/articulos.php');
    include_once('../ventas/ventas.php');
    include_once('../ventas/ventas_detalle.php');
    
    Conexion::conectar();
    
    $ventas = new Ventas();
    $ventas_detalle = new VentasDetalle($_REQUEST['venta']);
    
    $detalle = new DetalleVenta($_REQUEST['venta'], $ventas, $ventas_detalle);
    $detalle->mostrar_detalle();

?>