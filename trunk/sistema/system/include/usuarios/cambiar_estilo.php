<?php

    include_once("include/util.php");
    
    $query = "
        UPDATE
            usuarios_opciones  
        SET
            estilo = ".$_REQUEST['estilo']."
        WHERE
            usuario = ".$_COOKIE['usuario'];
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
        
    if (!registrar_movimiento(27, $_REQUEST['estilo'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se ha cambiado el estilo!");
    
?>

<script>
    
    window.location = ".";
    
</script>