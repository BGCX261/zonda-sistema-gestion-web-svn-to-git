<?php
    include_once('include/conexion.php');
    include_once('include/table_handler.php');
    include_once('include/ventas/ventas.php');
    include_once('include/clientes/pendientes.php');
    include_once('include/clientes/facturas_cobrar.php');
    Conexion::conectar();
    $pendientes = new ClientesPendientes();
    $facturas = new FacturasPorCobrar();
?>
<h2>menú clientes</h2>
<ul id="submenu_clientes">
    <li>
        <a href="?include=clientes&form=form_edicion&type=alta" title="Agregar un cliente">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/nuevo.png' />
            Nuevo cliente
        </a>
    </li>
    <li>
        <a href="?include=clientes&form=listado_clientes&inicio=0&cantidad=25&orden=codigo&direccion=ASC" title="Listado de clientes">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/listado.png' />
            Listado de clientes
        </a>
    </li>
    <li>
        <a href="?include=clientes&form=listado_facturas_cobrar&inicio=0&cantidad=25&orden=codigo&direccion=ASC" title="Listado de facturas por cobrar">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/factura.png' />
            Facturas por cobrar
            <?php 
                $total = $facturas->get_count();
                if ($total > 0) {
                    print '['.$total.']';
                }
            ?>
        </a>
    </li>
    <li>
        <a href="?include=clientes&form=listado_agenda_pagos&inicio=0&cantidad=25&orden=codigo&direccion=ASC" title="Agenda de pagos de clientes">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/fondos.png' />
            Agenda de pagos
        </a>
    </li>
    <li>
        <a href="?include=clientes&form=listado_pendientes" title="Clientes pendientes de revisión">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/reloj.png' />
            Pendientes de alta
            <?php 
                $total = $pendientes->get_count();
                if ($total > 0) {
                    print '['.$total.']';
                }
            ?>
        </a>
    </li>
</ul>