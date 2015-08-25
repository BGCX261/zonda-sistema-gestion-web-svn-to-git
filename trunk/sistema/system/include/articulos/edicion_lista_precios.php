<?php
    
    $query = "
        UPDATE
            listas_precios
        SET 
            codigo = ".$_REQUEST['codigo'].", 
            descripcion = '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."'
        WHERE
            codigo = ".$_REQUEST['codigo-original'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha editado la lista de precios';
    
?>