<?php

    $query = "DELETE FROM listas_precios WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $query = "DELETE FROM listas_precios_detalle WHERE lista = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha borrado la lista de precios';
    
?>