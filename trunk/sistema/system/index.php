<?php

    include_once("include/conexion.php");
    include_once("include/sesion.php");
    
    $conexion = new Conexion();
    
    if (!$conexion->conectar()) {
        header('Location: ../');
    }
    
    $sesion = new Sesion();
    
    if (!$sesion->is_logged()) {
        if (!$sesion->login()) {
            header('Location: ../');
        }
        else {
            header('Location: .');
        }
    }
    else {
        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'salir') {
            $sesion->logout();
            header('Location: ../');
        }
    }
    
    include_once("include/lista_articulos.php");
    
    session_start();
    
    if (!isset($_SESSION["lista_articulos"])) {
        $_SESSION["lista_articulos"] = new ListaArticulos();
    }
?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Zonda &rArr; Sistema de gesti&oacute;n web</title>
        <meta name="generator" content="Netbeans IDE 7.4 (2013)">
        <meta name="author" content="Juan Manuel Scarciofolo">
        <meta name="date" content="2013-10-30T14:58:11-0300">
        <meta name="keywords" content="sistema, gestión, web, online, administración, negocio, ventas, compras, php, javascript, mysql">
        <meta name="description" content="Sistema de gestión en línea para negocios y empresas">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="expires" content="0">
        <!-- JQUERY -->
        <script type="text/javascript" src="scripts/lib/jquery-1.11.1.js"></script>
        <script type="text/javascript" src="scripts/lib/jquery/js/jquery-ui-1.9.2.custom.min.js"></script>
        <script type="text/javascript" src="scripts/lib/chosen/chosen.jquery.min.js"></script>
        <!-- HIGHCHARS -->
        <!-- <script src="scripts/lib/highcharts/highcharts.js"></script>
        <script src="scripts/lib/highcharts/modules/exporting.js"></script>-->
        <!-- SCRIPTS DEL SISTEMA -->
        <script type="text/javascript" src="scripts/principal.js"></script>
        <?php if (isset($_REQUEST["include"])) { ?>
            <script type="text/javascript" src="include/<?php print $_REQUEST["include"]; ?>/<?php print $_REQUEST["include"]; ?>.js"></script>
            <?php
                if ($_REQUEST["include"] == 'compras' || $_REQUEST["include"] == 'ventas') {
                    print '<script type="text/javascript" src="include/factura.js"></script>';
                }
            ?>
        <?php } 
            $sesion->get_style_link();
            date_default_timezone_set("America/Argentina/Buenos_Aires");
        ?>
        <link href="scripts/lib/chosen/chosen.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor">
            <?php include_once("header.php"); ?>
            <div id="principal">
                <div id="mascara-carga-datos"></div>
                <div id="carga-datos">
                    <p class="campo-busqueda-p">
                        <input type="text" name="campo-busqueda" class="campo campo-entrada ui-widget-content ui-corner-all" placeholder="Comience a escribir para encontrar resultados..." />
                    </p>
                    <div class="contenedor-tabla">
                        <table id="tabla-busqueda"></table>
                    </div>
                </div>
                <div id="cuerpo">
                    <div id="panel">
                        <?php
                            if (isset($_REQUEST["include"])) {
                                $include = $_REQUEST["include"];
                                if (isset($_REQUEST["action"])) {
                                    $action = $_REQUEST["action"];
                                    include_once("include/$include/$action.php");
                                }
                                if (isset($_REQUEST["form"])) {
                                    $form = $_REQUEST["form"];
                                    include_once("include/$include/$form.php");
                                }
                            }
                            else {
                                include_once("inicio.php");
                            }
                        ?>
                    </div>
                    <input type="hidden" id="codigo_lista" value="" />
                </div>
                <div id="menu_options">
                    <div id="menu_options_top"></div>
                    <div id="menu_options_body">
                    <?php
                        include_once("include/inicio/menu.php");
                        include_once("include/articulos/menu.php");
                        include_once("include/compras/menu.php");
                        include_once("include/ventas/menu.php");
                        include_once("include/clientes/menu.php");
                        include_once("include/proveedores/menu.php");
                        include_once("include/fondos/menu.php");
                        include_once("include/configuracion/menu.php");
                        include_once("include/usuarios/menu.php");
                        include_once("include/base/menu.php");
                    ?>
                    </div>
                    <div id="menu_options_bottom"></div>
                </div>
                <?php include_once("footer.php"); ?>
            </div>
        </div>
        <div id="dialogo"></div>
        <?php if (isset($action_message)) { ?>
            <script>
                $('#dialogo').dialog({ modal: true, width: 400, height: 150 });
                $('#dialogo').html('<p class="mensaje-accion"><?php print $action_message; ?></p>');
                $('#dialogo').dialog('open');
            </script>
        <?php } ?>
    </body>
</html>