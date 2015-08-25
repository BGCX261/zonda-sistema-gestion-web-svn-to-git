<?php

    include ('include/util.php');
    
    $query = "
        UPDATE
            articulos
        SET
            existencia = ".$_REQUEST['existencia']."
        WHERE
            codigo = ".$_REQUEST['codigo'] ;
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    if (!registrar_movimiento(57, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg('Se ha ajustado el stock!');
    
?>