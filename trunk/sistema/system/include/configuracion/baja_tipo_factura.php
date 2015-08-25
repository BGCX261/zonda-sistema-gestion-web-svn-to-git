<?php

    include ('include/util.php');
    
    $query = "DELETE FROM facturas_tipo WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
        
    if (!registrar_movimiento(30, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha borrado el tipo de factura!");
    
?>