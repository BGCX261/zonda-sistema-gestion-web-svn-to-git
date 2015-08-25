<?php

    include_once('include/util.php');
    
    $query = "
        INSERT INTO usuarios (
            nombre,
            apodo,
            clave,
            correo
            ) 
        VALUES (
            '".verificar_sql($_REQUEST['nombre'])."',
            '".verificar_sql($_REQUEST['apodo'])."',
            MD5('" .$_REQUEST['clave']."'),
            '".verificar_sql($_REQUEST['correo'])."'
        )";
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    $Codigo = mysql_insert_id();
    
    if (!registrar_movimiento(49, $_COOKIE['usuario'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se a agregado el usuario al sistema!");
    
?>