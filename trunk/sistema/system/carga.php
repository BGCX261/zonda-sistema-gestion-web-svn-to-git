<?php
    if (isset($_COOKIE["usuario"]) && isset($_COOKIE["clave"])) {
        print "<a href='system'>Siga el enlace para ingresar al sistema.</a>";
        return;
    }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Gestión Web</title>
        <meta name="generator" content="Komodo Edit 7">
        <meta name="author" content="Juan Manuel Scarciofolo">
        <meta name="date" content="2013-01-06T00:43:51-0300">
        <meta name="keywords" content="sistema, gestión, web, online, administración, negocio, ventas, compras, php, javascript, mysql">
        <meta name="description" content="Sistema de gestión en línea para negocios y empresas">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="expires" content="0">
        <link href="system/styles/soft/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="contenedor" align="center" style="margin-top: 100px">
            <div id="cuadroIngreso">
                <div id="formularioIngreso">
                    <h1><img src="system/images/logo.png"></h1>
                    <p>
                        
                    </p>
                    <br />
                    <button id='boton-ingresar'>Aceptar</button>
                </div>
            </div>
        </div>
        <div id="dialogo-alerta" title="Gestion Web dice:">
            <p align="center"></p>
        </div>
    </body>
</html>
