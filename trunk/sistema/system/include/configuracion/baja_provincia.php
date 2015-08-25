<?php
    include_once('include/configuracion/provincias.php');
    
    $provincias = new Provincias();
    
    $action_message = "Se ha borrado la provincia";
    
    if (!$provincias->delete_provincia($_REQUEST['codigo'])) {
        $action_message = mysql_error();
    }
?>