<?php
    $Hoy = date('d/m/Y');
    $MesPasado = date('d/m/Y', mktime(0, 0, 0, date('m') - 1, date('d'), date('Y')));
?>
<h2>menú informes</h2>
<div class="menu-acordeon">
    <h3>Artículos</h3>
    <div>
        <ul>
            <li>
                <a href="?include=informes&form=articulos_listado&orden=articulos.codigo&direccion=ASC">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado general
                </a>
            </li>
            <li>
                <a href="?include=informes&form=articulos_categoria&orden=articulos.codigo&direccion=ASC">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado por categorías
                </a>
            </li>
            <li>
                <a href="?include=informes&form=articulos_proveedor&orden=articulos.codigo&direccion=ASC">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado por proveedores
                </a>
            </li>
            <li>
                <a href="?include=informes&form=articulos_ventas&orden=articulos.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Ranking de ventas
                </a>
            </li>
            <li>
                <a href="?include=informes&form=articulos_no_vendidos&orden=articulos.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Artículos no vendidos
                </a>
            </li>
        </ul>
    </div>
    <h3>Compras</h3>
    <div>
        <ul>
            <li>
                <a href="?include=informes&form=compras_listado&orden=compras.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado de compras
                </a>
            </li>
            <li>
                <a href="?include=informes&form=compras_detalles&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Detalle de compras
                </a>
            </li>
            <li>
                <a href="?include=informes&form=compras_categoria&orden=categorias.categoria&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado por categorías
                </a>
            </li>
            <li>
                <a href="?include=informes&form=compras_proveedor&orden=proveedores.razon&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado por proveedores
                </a>
            </li>
            <li>
                <a href="?include=informes&form=compras_resumen&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Resumen de compras
                </a>
            </li>
        </ul>
    </div>
    <h3>Ventas</h3>
    <div>
        <ul>
            <li>
                <a href="?include=informes&form=ventas_listado&orden=ventas.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado de ventas
                </a>
            </li>
            <li>
                <a href="?include=informes&form=ventas_detalles&orden=ventas.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Detalle de ventas
                </a>
            </li>
            <li>
                <a href="?include=informes&form=ventas_categoria&orden=categorias.categoria&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado por categorías
                </a>
            </li>
            <li>
                <a href="?include=informes&form=ventas_cliente&orden=clientes.razon&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado por clientes
                </a>
            </li>
            <li>
                <a href="?include=informes&form=ventas_articulo&valor=1&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Ventas por artículo
                </a>
            </li>
            <li>
                <a href="?include=informes&form=ventas_categoria_grafico&valor=1&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Ventas por categoría
                </a>
            </li>
            <li>
                <a href="?include=informes&form=ventas_cliente_grafico&valor=1&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Ventas por cliente
                </a>
            </li>
            <li>
                <a href="?include=informes&form=ventas_resumen&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Resumen de ventas
                </a>
            </li>
        </ul>
    </div>
    <h3>Clientes</h3>
    <div>
        <ul>
            <li>
                <a href="?include=informes&form=clientes_listado&orden=clientes.codigo&direccion=ASC">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado general
                </a>
            </li>
            <li>
                <a href="?include=informes&form=clientes_articulos&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Artículos comprados
                </a>
            </li>
            <li>
                <a href="?include=informes&form=clientes_categorias&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Artículos por categoría
                </a>
            </li>
            <li>
                <a href="?include=informes&form=clientes_pagadas&orden=ventas.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Facturas cobradas
                </a>
            </li>
            <li>
                <a href="?include=informes&form=clientes_cobrar&orden=ventas.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Facturas pendientes
                </a>
            </li>
            <li>
                <a href="?include=informes&form=clientes_pagos&orden=cobros.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Pagos realizados
                </a>
            </li>
            <li>
                <a href="?include=informes&form=clientes_pagos_grafico&valor=1&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Desarrollo de pagos
                </a>
            </li>
            <li>
                <a href="?include=informes&form=clientes_deuda_grafico&valor=1&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Saldo por cliente
                </a>
            </li>
            <li>
                <a href="?include=informes&form=clientes_resumen&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Resumen de clientes
                </a>
            </li>
        </ul>
    </div>
    <h3>Proveedores</h3>
    <div>
        <ul>
            <li>
                <a href="?include=informes&form=proveedores_listado&orden=proveedores.codigo&direccion=ASC">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Listado general
                </a>
            </li>
            <li>
                <a href="?include=informes&form=proveedores_articulos&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Artículos comprados
                </a>
            </li>
            <li>
                <a href="?include=informes&form=proveedores_categorias&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Artículos por categoría
                </a>
            </li>
            <li>
                <a href="?include=informes&form=proveedores_pagadas&orden=compras.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Facturas pagadas
                </a>
            </li>
            <li>
                <a href="?include=informes&form=proveedores_cobrar&orden=compras.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Facturas pendientes
                </a>
            </li>
            <li>
                <a href="?include=informes&form=proveedores_pagos&orden=pagos.codigo&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Pagos realizados
                </a>
            </li>
        </ul>
    </div>
    <h3>Fondos</h3>
    <div>
        <ul>
            <li>
                <a href="?include=informes&form=fondos_operaciones&orden=descripcion&direccion=ASC&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/informe.png' />
                    Operaciones realizadas
                </a>
            </li>
            <li>
                <a href="?include=informes&form=fondos_desarrollo_grafico&valor=1&fecha-inicio=<?php print $MesPasado; ?>&fecha-fin=<?php print $Hoy; ?>">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/grafico.png' />
                    Desarrollo de los fondos
                </a> 
            </li>
        </ul>
    </div>
</div>
