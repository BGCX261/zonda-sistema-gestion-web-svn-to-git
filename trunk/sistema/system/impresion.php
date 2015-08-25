<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
        <title>Gestión Web</title>
        <meta name="generator" content="Netbeans IDE 7.4">
        <meta name="author" content="Juan Manuel Scarciofolo">
        <meta name="date" content="2013-12-25T22:14:25-0300">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="expires" content="0">
        <link href="styles/impresion.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="panel">
            <?php
                include_once('conexion.php');
                include_once($_REQUEST['form'].'.php');
            ?>
        </div>
    </body>
</html>