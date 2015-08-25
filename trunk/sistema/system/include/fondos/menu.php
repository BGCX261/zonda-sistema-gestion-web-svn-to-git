<h2>menú fondos</h2>
<ul id="submenu_fondos">
    <li>
        <a href="?include=fondos&form=form_edicion&type=alta">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/nuevo.png' />
            Agregar fondo
        </a>
    </li>
    <li>
        <a href="?include=fondos&form=listado_fondos&inicio=0&cantidad=100&orden=fondos.codigo&direccion=ASC">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/listado.png' />
            Listado de fondos
        </a>
    </li>
    <li>
        <a href="?include=fondos&form=form_debito">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/debito.png' />
            Débitos
        </a>
    </li>
    <li>
        <a href="?include=fondos&form=form_credito">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/credito.png' />
            Créditos
        </a>
    </li>
</ul>