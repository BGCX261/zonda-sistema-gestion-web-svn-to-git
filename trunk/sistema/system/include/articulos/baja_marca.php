<?php

    $query = "DELETE FROM marcas WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha eliminado la marca';
    
?>