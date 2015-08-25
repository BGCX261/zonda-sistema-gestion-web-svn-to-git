<h2>menú inicio</h2>
<ul id="submenu_usuarios">
    <li>
        <a href="?include=usuarios&form=form_estilo">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/estilo.png' />
            Cambiar estilo
        </a>
    </li>
    <li>
        <a href="?include=usuarios&form=form_edicion">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/usuario.png' />
            Cambiar información
        </a>
    </li>
    <li>
        <a href="?include=usuarios&form=form_salir">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/salir.png' />
            Salir
        </a>
    </li>
</ul>