<?php
    include_once("lista_articulos.php");
    
    session_start();
    
    if (isset($_SESSION["lista_articulos"])) {
        $_SESSION["lista_articulos"]->remove($_REQUEST['codigo']);
        print '0';
    }
?>
