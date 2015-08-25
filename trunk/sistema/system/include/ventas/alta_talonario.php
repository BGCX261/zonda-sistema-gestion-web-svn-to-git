<?php

    include ('include/util.php');
    
    $query = "INSERT INTO
            talonarios (
                codigo,
                descripcion,
                fecha,
                inicio,
                actual 
            ) VALUES (
                ".$_REQUEST['codigo'].",
                '".verificar_sql($_REQUEST['descripcion'])."',
                now(),
                ".verificar_sql($_REQUEST['inicio']).",
                ".verificar_sql($_REQUEST['actual'])."
            )";
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
        
    if (!registrar_movimiento(46, $_REQUEST['codigo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha agregado el talonario!");
    
?>