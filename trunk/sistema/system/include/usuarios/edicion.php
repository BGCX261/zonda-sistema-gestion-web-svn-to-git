<?php

    include_once('include/util.php');
    
    $query = "
        UPDATE
            usuarios 
        SET
            nombre = '".verificar_sql($_REQUEST['nombre'])."',
            apodo = '".verificar_sql($_REQUEST['apodo'])."', 
        ";
    
    if (isset($_REQUEST['clave']) && $_REQUEST['clave'] != '') {
        $query .= " clave = MD5('".$_REQUEST['clave'] ."'), ";
    }
    
    $query .= "
            correo = '".$_REQUEST['correo']."'
        WHERE
            codigo = ";
    
    if(isset($_REQUEST['codigo'])) {
        $query .= $_REQUEST["codigo"];
    }
    else {
        $query .= $_COOKIE["usuario"];
    }
    
    if (!mysql_query($query)) {
        sql_error_msg();
        return;
    }
    
    if (!registrar_movimiento(50, $_COOKIE['usuario'])) { 
        sql_error_msg();
        return;
    }
    
    success_msg("Se han actualizado los datos del usuario!");
    
?>