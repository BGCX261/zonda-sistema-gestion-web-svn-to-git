<h2>menú base de datos</h2>
<ul id="submenu_base">
    <li>
        <a href="backup.php" title="Generar un archivo con la información de la base de datos">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/exportar.png" />
            Exportar base de datos
        </a>
    </li>
    <li>
        <a href="backup_data.php" title="Realizar un archivo de respaldo de la base de datos">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/respaldo.png" />
            Respaldo de datos
        </a>
    </li>
    <li>
        <a href="recuperar.php" title="Subir un archivo de respaldo a la base de datos">
            <img src="styles/<?php print $sesion->get_style(); ?>/images/recuperar.png" />
            Recuperación de datos
        </a>
    </li>
</ul>