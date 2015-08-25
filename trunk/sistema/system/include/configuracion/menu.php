<h2>menú configuración</h2>
<ul id="submenu_configuracion">
    <li>
        <a href="?include=configuracion&form=form_edicion_empresa">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/editar.png' />
            Datos de la empresa
        </a>
    </li>
    <li>
        <a href="?include=configuracion&form=listado_provincias">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/mapa.png' />
            Provincias
        </a>
    </li>
    <li>
        <a href="?include=configuracion&form=listado_localidades&provincia=1">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/mapa.png' />
            Localidades
        </a>
    </li>
    <li>
        <a href="?include=configuracion&form=listado_condiciones_venta">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/dinero.png' />
            Condiciones de venta
        </a>
    </li>
    <li>
        <a href="?include=configuracion&form=listado_alicuotas">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/alicuota.png' />
            Alícuotas
        </a>
    </li>
    <li>
        <a href="?include=configuracion&form=listado_tipos_facturas">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/ticket.png' />
            Tipos de factura
        </a>
    </li>
</ul> 
