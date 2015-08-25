<?php
    
    $query = "DELETE FROM usuarios WHERE codigo = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        sql_error_msg();
        return;
    }
    
    if (!registrar_movimiento(51, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha eliminado el usuario!");
    
?>