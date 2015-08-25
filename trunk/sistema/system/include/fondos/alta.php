<?php

    $query = "
        INSERT INTO fondos (
            codigo,
            descripcion,
            saldo
        )
        VALUES (
            ".$_REQUEST['codigo'].",
            '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."',
            ".$_REQUEST['saldo'] ."
        )";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha agregado el fondo!";
    
?>