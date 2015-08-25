<?php
    header("Content-Type: application/vnd.ms-excel");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment; filename=gestionweb-informe.xls");
?>
<html>
    <head>
        <title>Gestión Web</title>
        <meta name="generator" content="Netbeans IDE 7.4">
        <meta name="author" content="Juan Manuel Scarciofolo">
        <meta name="date" content="2013-12-25T22:36:48-0300">
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta http-equiv="content-type" content="application/xhtml+xml; charset=UTF-8">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="expires" content="0">
    </head>
    <body>
        <?php
            include_once('conexion.php');
            include_once($_REQUEST['form'].'.php');
        ?>
    </body>
</html>