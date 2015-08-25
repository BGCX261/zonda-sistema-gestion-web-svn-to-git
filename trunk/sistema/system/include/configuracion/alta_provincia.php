<?php
    include_once('include/configuracion/provincias.php');
    
    $provincias = new Provincias();
    
    $action_message = "Se ha agregado la provincia";
    
    if (!$provincias->add_provincia($_REQUEST['descripcion'])) {
        $action_message = mysql_error();
    }
?>