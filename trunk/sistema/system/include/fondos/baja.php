<?php

    $query = "DELETE FROM fondos WHERE codigo = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha eliminado el fondo!";
    
?>