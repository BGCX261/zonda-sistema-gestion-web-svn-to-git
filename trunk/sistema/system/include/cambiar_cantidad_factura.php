<?php
    include_once("lista_articulos.php");
    
    session_start();
    
    if (isset($_SESSION["lista_articulos"])) {
        $_SESSION["lista_articulos"]->change_quantity($_REQUEST['codigo'], $_REQUEST['cantidad']);
        print '0';
    }
?>
