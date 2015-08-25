<?php 
    /* HEADER */ 
?>

    <div id="logo_enc">
        <div id="logo">
            <a href="."></a>
            <!--Logo here-->
        </div>
        <?php
            include('menu-header.php');
        ?>
    </div>
    <div id="encabezado">
        <div id="enc_izq"></div>
        <div id="enc_der"></div>
        <div id="menu_enc">
            <ul>
                <li id="menu_inicio" class="menu_enc_li<?php if(!isset($_REQUEST['include']) || $_REQUEST['include'] == 'inicio') { print ' selected'; } ?>" title="Inicio">
                    <a href=".">inicio</a>
                </li>
                <li id="menu_articulos" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'articulos') { print ' selected'; } ?>" title="Artículos">
                    <a href="?include=articulos&form=listado&inicio=0&cantidad=25&orden=articulos.codigo&direccion=ASC">artículos</a>
                </li>
                <li id="menu_compras" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'compras') { print ' selected'; } ?>" title="Compras">
                    <a href="?include=compras&form=form_compra">compras</a>
                </li>
                <li id="menu_ventas" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'ventas') { print ' selected'; } ?>" title="Ventas">
                    <a href="?include=ventas&form=form_venta">ventas</a>
                </li>
                <li id="menu_clientes" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'clientes') { print ' selected'; } ?>" title="Clientes">
                    <a href="?include=clientes&form=listado_clientes&inicio=0&cantidad=25&orden=clientes.codigo&direccion=ASC">clientes</a>
                </li>
                <li id="menu_proveedores" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'proveedores') { print ' selected'; } ?>" title="Proveedores">
                    <a href="?include=proveedores&form=listado_proveedores&inicio=0&cantidad=25&orden=proveedores.codigo&direccion=ASC">proveedores</a>
                </li>
                <li id="menu_fondos" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'fondos') { print ' selected'; } ?>" title="Fondos">
                    <a href="?include=fondos&form=listado_fondos&inicio=0&cantidad=25&orden=fondos.codigo&direccion=ASC">fondos</a>
                </li>
                <li id="menu_configuracion" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'configuracion') { print ' selected'; } ?>" title="Configuración">
                    <a href="?include=configuracion">configuración</a>
                </li>
                <li id="menu_usuarios" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'usuarios') { print ' selected'; } ?>" title="Usuarios">
                    <a href="?include=usuarios">usuarios</a>
                </li>
                <li id="menu_informes" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'informes') { print ' selected'; } ?>" title="Informes">
                    <a href="?include=informes">informes</a>
                </li>
                <li id="menu_base" class="menu_enc_li<?php if(isset($_REQUEST['include']) && $_REQUEST['include'] == 'base') { print ' selected'; } ?>" title="Base de datos">
                    <a href="?include=base">base de datos</a>
                </li>
            </ul>
        </div>
    </div>
 