<?php
    include_once('include/conexion.php');
    include_once('include/table_handler.php');
    include_once('include/compras/compras.php');
    include_once('include/proveedores/facturas_pagar.php');
    Conexion::conectar();
    $facturas = new FacturasPorPagar();
?>
<h2>menú proveedores</h2>
<ul id="submenu_proveedores">
    <li>
        <a href="?include=proveedores&form=form_edicion&type=alta" title="Agregar un nuevo proveedor">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/nuevo.png" />
            Nuevo proveedor
        </a>
    </li>
    <li>
        <a href="?include=proveedores&form=listado_proveedores&inicio=0&cantidad=100&orden=proveedores.codigo&direccion=ASC" title="Listado de proveedores">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/listado.png" />
            Listado de proveedores
        </a>
    </li>
    <li>
        <a href="?include=proveedores&form=listado_facturas_pagar&inicio=0&cantidad=100&orden=compras.codigo&direccion=ASC" title="Listado de facturas por pagar">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/factura.png" />
            Facturas por pagar
            <?php 
                $total = $facturas->get_count();
                if ($total > 0) {
                    print '['.$total.']';
                }
            ?>
        </a>
    </li>
    <li>
        <a href="?include=proveedores&form=listado_agenda_pagos&inicio=0&cantidad=25&orden=codigo&direccion=ASC" title="Agenda de pagos a proveedores">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/fondos.png' />
            Agenda de pagos
        </a>
    </li>
</ul>