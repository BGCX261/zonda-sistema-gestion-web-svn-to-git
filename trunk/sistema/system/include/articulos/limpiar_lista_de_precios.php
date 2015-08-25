<?php
    
    $query = "DELETE FROM listas_precios_detalle WHERE lista = ".$_REQUEST['lista'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha limpiado la lista de precios';
    
?>