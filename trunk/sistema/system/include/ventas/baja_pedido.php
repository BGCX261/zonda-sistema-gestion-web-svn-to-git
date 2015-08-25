<?php
    
    $query = "DELETE FROM pedidos WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $query = "DELETE FROM pedidos_detalle WHERE pedido = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha eliminado el pedido";
    
?>