<?php
    include_once('include/configuracion/provincias.php');
    
    $provincias = new Provincias();
    
    $action_message = "Se ha editado la provincia";
    
    if (!$provincias->edit_provincia($_REQUEST['codigo'], $_REQUEST['descripcion'])) {
        $action_message = mysql_error();
    }
?>