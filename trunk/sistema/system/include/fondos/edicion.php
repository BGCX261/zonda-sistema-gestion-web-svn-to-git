<?php

    $query = "
        UPDATE
            fondos
        SET
            descripcion = '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."'
        WHERE
            codigo = ".$_REQUEST['codigo'] ;
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha editado el registro fondo!";
    
?>