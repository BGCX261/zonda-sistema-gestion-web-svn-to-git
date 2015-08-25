<?php
    include_once('include/configuracion/localidades.php');
    
    $localidades = new Localidades(0);
    
    $action_message = "Se ha editado la localidad";
    
    if (!$localidades->edit_localidad($_REQUEST['codigo'], $_REQUEST['descripcion'])) {
        $action_message = mysql_error();
    }
?>