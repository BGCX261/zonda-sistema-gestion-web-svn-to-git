<?php
    include_once('include/configuracion/localidades.php');
    
    $localidades = new Localidades(0);
    
    $action_message = "Se ha borrado la localidad";
    
    if (!$localidades->delete_localidad($_REQUEST['codigo'])) {
        $action_message = mysql_error();
    }
?>