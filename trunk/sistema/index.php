<?php
    include_once('system/include/conexion.php');
    include_once('system/include/sesion.php');
    
    $conexion = new Conexion();
    $conexion->conectar();
    $sesion = new Sesion();
    
    if ($sesion->is_logged()) {
        header('Location: system/');
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Zonda &rArr; Sistema de gestión web</title>
        <meta name="generator" content="Netbeans IDE 7.4 (2013)">
        <meta name="author" content="Juan Manuel Scarciofolo">
        <meta name="date" content="2013-12-10T16:43:22-0300">
        <meta name="keywords" content="sistema, gestión, web, online, administración, negocio, ventas, compras, php, javascript, mysql">
        <meta name="description" content="Sistema de gestión en línea para negocios y empresas">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="expires" content="0">
        <script type="text/javascript" src="system/scripts/lib/jquery-1.9.1.min.js"></script>
        <link href="system/styles/flat/style.css" rel="stylesheet" type="text/css">
        <link href="system/styles/flat/controls.css" rel="stylesheet" type="text/css">
        <style>
            .header {
                background: #222 url(styles/flat/images/pw_maze_black.png); 
                height: 45px; 
                width: 100%;
            }
            .header ul {
                list-style: none;
                margin: 0px;
                padding: 0px;
                margin-right: 10px;
            }
            .header ul li {
                float: right; 
                padding: 10px;
                margin-top: 4px;
            }
            .header ul li a {
                color: #CCC;
                text-decoration: none;
            }
            .header ul li a:hover {
                color: #FFF;
            }
            .contenedor {
                margin-top: 110px;
                text-align: center;
            }
            .formulario-ingreso {
                width: 500px; 
                margin: auto;
            }
            .formulario-ingreso img {
                margin-bottom: 35px;
                font-size: 100px;
            }
            .campos-form {
                float: left;
            }
            .espaciador {
                width: 90px;
            }
            .campos {
                width: 220px;
            }
            .boton {
                padding: 4px;
            }
        </style>
    </head>
    <body>
        <?php
            include_once('system/include/formulario.php');
            include_once('system/include/campo.php');
            include_once('system/include/boton.php');
            
            $formulario = new Formulario();
            $formulario->set_action_uri('system/');
            $campo_nombre = new Campo('grovi', '', '', 'text');
            $campo_nombre->add_class('campo-square');
            $campo_nombre->set_placeholder('Ingrese su nombre de usuario');
            $campo_nombre->set_required();
            $campo_pass = new Campo('redemp', '', '', 'password');
            $campo_pass->add_class('campo-square');
            $campo_pass->set_placeholder('Ingrese su clave de acceso');
            $campo_pass->set_required();
            $boton = new Boton('aceptar', 'Ingresar');
            $boton->add_class('boton-flat-square');
        ?>
        <div class="header">
            <ul>
                <li>
                    <a href="">&raquo; Contacto</a>
                </li>
                <li>
                    <a href="">&raquo; Olvid&eacute; mi contrase&ntilde;a</a>
                </li>
            </ul>
        </div>
        <div class="contenedor">
            <div>
                <div class="formulario-ingreso">
                    <img src="system/images/logo-300.png" alt="ZONDA" />
                    <?php 
                        $formulario->open();
                    ?>
                    <div class="campos-form espaciador">&nbsp;</div>
                    <div class="campos-form campos">
                        <?php
                            $campo_nombre->show();
                            $campo_pass->show();
                        ?>
                    </div>
                    <div class="campos-form boton">
                        <?php
                            $boton->show();
                        ?>
                    </div>
                    <?php
                        $formulario->close();
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>