<h2>menú inicio</h2>
<ul id="submenu_inicio">
    <li <?php if(!isset($_REQUEST['include'])) { print 'class="selected"'; } ?>>
        <a href=".">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/inicio.png' />
            Inicio
        </a>
    </li>
    <li <?php if(isset($_REQUEST['form']) && $_REQUEST['form'] == 'ayuda') { print 'class="selected"'; } ?>>
        <a href="?include=inicio&form=ayuda">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/help.png' />
            Ayuda
        </a>
    </li>
    <li <?php if(isset($_REQUEST['form']) && $_REQUEST['form'] == 'acerca') { print 'class="selected"'; } ?>>
        <a href="?include=inicio&form=acerca">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/about.png' />
            Acerca de...
        </a>
    </li>
    <?php
        include_once('conexion.php');
        $Result = mysql_query("SELECT * FROM registro");
        if (!$Result || mysql_num_rows($Result) < 1) {
    ?>
            <li <?php if(isset($_REQUEST['form']) && $_REQUEST['form'] == 'registro') { print 'class="selected"'; } ?>>
                <a href="?include=inicio&form=registro">
                    <img src='styles/<?php print $sesion->get_style(); ?>/images/key.png' />
                    Registrar el sistema
                </a>
            </li>
    <?php
        }
    ?>
    <li <?php if(isset($_REQUEST['form']) && $_REQUEST['form'] == 'form_salir') { print 'class="selected"'; } ?>>
        <a href="?include=inicio&form=form_salir">
            <img src='styles/<?php print $sesion->get_style(); ?>/images/exit.png' />
            Salir
        </a>
    </li>
</ul>