<?php

    include ('include/util.php');
    
    $query = "DELETE FROM talonarios WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
        
    if (!registrar_movimiento(48, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha eliminado el talonario!");
    
?>