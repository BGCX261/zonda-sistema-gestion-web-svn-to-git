<?php
    include_once("include/conexion.php");
    include_once("include/table_handler.php");
    include_once("include/tabla.php");
    include_once("include/lista_articulos.php");
    include_once("include/articulos/articulos.php");
    include_once("include/articulos/lista_de_precios.php");
    include_once("include/clientes/clientes.php");
    include_once("include/configuracion/alicuotas.php");
    include_once("include/ventas/pedidos.php");
    include_once("include/ventas/pedidos_detalle.php");
    
    Conexion::conectar();
    
    if (isset($_SESSION["lista_articulos"])) {
        $_SESSION["lista_articulos"]->clear();
        $pedido = $_REQUEST['codigo'];
        $articulos = new Articulos();
        $alicuotas = new Alicuotas();
        $clientes = new Clientes();
        $pedidos = new Pedidos();
        if ($pedidos->exists($pedido)) {
            $pedidos_detalle = new PedidosDetalle($pedido);
            $cliente = $pedidos->get_field('cliente', $pedido);
            $lista = $clientes->get_field('lista', $cliente);
            $lista_precios = new ListaDePrecios($lista);
            $result = $pedidos_detalle->get_result();
            while ($row = mysql_fetch_row($result)) {
                $art = $articulos->get_articulo($row[2]);
                $_SESSION["lista_articulos"]->add($art['codigo'], $art['descripcion'], $lista_precios->get_precio($art['codigo']), $alicuotas->get_field('alicuota', $art['alicuota']), $row[3]);
            }
        }
        include_once("include/ventas/form_venta.php");
    }
?>