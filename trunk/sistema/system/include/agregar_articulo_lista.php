<?php
    include_once("conexion.php");
    include_once("table_handler.php");
    include_once("tabla.php");
    include_once("lista_articulos.php");
    include_once("articulos/articulos.php");
    include_once("configuracion/alicuotas.php");
    
    Conexion::conectar();
    
    session_start();
    
    if (isset($_SESSION["lista_articulos"])) {
        $articulos = new Articulos();
        $alicuotas = new Alicuotas();
        $art = $articulos->get_articulo($_REQUEST['codigo']);
        $_SESSION["lista_articulos"]->add($art['codigo'], $art['descripcion'], $art['precio'], $alicuotas->get_field(2, $art['alicuota']), 1);
    }
?>