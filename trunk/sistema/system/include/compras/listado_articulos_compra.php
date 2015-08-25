<?php
    include_once("../lista_articulos.php");
    include_once("../tabla_detalle_factura.php");
    
    session_start();
    
    if (isset($_SESSION["lista_articulos"])) {
        $articulos = $_SESSION["lista_articulos"]->get_items();
        $tabla = new TablaDetalleFactura('lista-articulos-compra');
        $tabla->set_data($articulos);
        $tabla->show();
    }
?>
