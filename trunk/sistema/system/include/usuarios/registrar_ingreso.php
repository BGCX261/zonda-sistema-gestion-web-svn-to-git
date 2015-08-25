<?php
    include_once('../../conexion.php');
    
    $Ip = "0.0.0.0";
    
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
        $Ip = $_SERVER['HTTP_CLIENT_IP'];
       
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        $Ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    
    if (!empty($_SERVER['REMOTE_ADDR']))
        $Ip = $_SERVER['REMOTE_ADDR'];
    
    $query = "
        INSERT INTO usuarios_registro (
            usuario,
            fecha,
            ip
            ) 
        VALUES (
            (
                SELECT codigo FROM usuarios WHERE apodo = '".$_POST['usuario']."'
            ),
            now(),
            '".$Ip."'
        )";
    
    if (!mysql_query($query)) {
       print "Ha ocurrido un error al intentar grabar la información en la base de datos! ";
       print mysql_error();
       return;
    }
    
    print "0";
?>