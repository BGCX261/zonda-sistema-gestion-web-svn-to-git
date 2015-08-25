<?php
    include_once('include/configuracion/localidades.php');
    
    $localidades = new Localidades($_REQUEST['provincia']);
    
    $action_message = "Se ha agregado la localidad";
    
    if (!$localidades->add_localidad($_REQUEST['descripcion'])) {
        $action_message = mysql_error();
    }
?>