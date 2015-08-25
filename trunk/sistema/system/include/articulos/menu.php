<h2>menú artículos</h2>
<ul id="submenu_articulos">
    <li>
        <a href="?include=articulos&form=form_edicion&type=alta" title="Agregar un art&iacute;culo">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/nuevo.png' />
            Nuevo
        </a>
    </li>
    <li>
        <a href="?include=articulos&form=listado&inicio=0&cantidad=25&orden=codigo&direccion=ASC" title="Listado de art&iacute;culos">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/listado.png' />
            Listado
        </a>
    </li>
    <li>
        <a href="?include=articulos&form=listado_categorias&inicio=0&cantidad=25&orden=codigo&direccion=ASC" title="Administraci&oacute;n de categor&iacute;as">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/categorias.png' />
            Categorías
        </a>
    </li>
    <li>
        <a href="?include=articulos&form=listado_marcas&inicio=0&cantidad=25&orden=codigo&direccion=ASC" title="Administraci&oacute;n de marcas">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/marcas.png' />
            Marcas
        </a>
    </li>
    <li>
        <a href="?include=articulos&form=listado_costos&inicio=0&cantidad=25&orden=codigo&direccion=ASC" title="Administraci&oacute;n de costos">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/precios.png' />
            Costos
        </a>
    </li>
    <li>
        <a href="?include=articulos&form=listado_listas_precios&inicio=0&cantidad=25&orden=listas_precio.codigo&direccion=ASC" title="Administraci&oacute;n de listas de precios">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/lista_precios.png' />
            Listas de precios
        </a>
    </li>
    <li>
        <a href="?include=articulos&form=form_ajuste" title="Ingresar o quitar art&iacute;culos del stock">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/lista_precios.png' />
            Ajuste de stock
        </a>
    </li>
</ul>