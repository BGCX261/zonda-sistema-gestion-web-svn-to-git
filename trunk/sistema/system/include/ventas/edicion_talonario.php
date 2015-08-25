<?php

    include ('include/util.php');
    
    $query = "UPDATE
            talonarios
        SET
            descripcion = '".verificar_sql($_REQUEST['descripcion'])."',
            inicio = ".verificar_sql($_REQUEST['inicio']).",
            actual = ".verificar_sql($_REQUEST['actual'])."
        WHERE
            codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    if (!registrar_movimiento(47, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha actualizado el talonario!");
    
?>