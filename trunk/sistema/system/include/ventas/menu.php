<h2>menú ventas</h2>
<ul id="submenu_ventas">
    <li>
        <a href="?include=ventas&form=form_venta" title="Iniciar una nueva venta">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/nuevo.png" />
            Nueva venta
        </a>
    </li>
    <li>
        <a href="?include=ventas&form=form_pedido" title="Iniciar un nuevo pedido">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/pedido.png" />
            Nuevo pedido
        </a>
    </li>
    <li>
        <a href="?include=ventas&form=listado_ventas&inicio=0&cantidad=100&orden=ventas.codigo&direccion=DESC" title="Listado de ventas realizadas">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/listado.png" />
            Listado de ventas
        </a>
    </li>
    <li>
        <a href="?include=ventas&form=listado_pedidos&inicio=0&cantidad=100&orden=pedidos.codigo&direccion=DESC" title="Listado de pedidos realizados">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/pedidos.png" />
            Listado de pedidos
        </a>
    </li>
</ul>