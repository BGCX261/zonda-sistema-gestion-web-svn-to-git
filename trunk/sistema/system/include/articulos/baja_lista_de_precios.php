<?php
    
    $query = "DELETE FROM listas_precios_detalle WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha quitado el artículo de la lista de precios';
    
?>