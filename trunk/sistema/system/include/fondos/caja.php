<?php
    
    include ('include/util.php');
    
    $query = "UPDATE fondos SET fondo_caja = 0 WHERE fondo_caja = 1";
    
    $return = mysql_query($query);
    
    if (!$return) {
        sql_error_msg();
        return;
    }
    
    $query = "UPDATE fondos SET fondo_caja = 1 WHERE codigo = ".$_REQUEST['codigo'];
    
    $return = mysql_query($query);
    
    if (!$return) {
        sql_error_msg();
        return;
    }
    
    /*
     * AGREGAR LA OPERACION EN LOS MOVIMIENTOS:
     */
    if (!registrar_movimiento(7, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha actualizado el fondo de caja!");
    
?>