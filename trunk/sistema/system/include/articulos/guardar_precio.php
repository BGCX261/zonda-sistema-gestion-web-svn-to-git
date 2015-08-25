<?php
    include_once('../conexion.php');
    
    Conexion::conectar();
    
    $query = "UPDATE listas_precios_detalle SET precio = ".$_REQUEST['precio']." WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        print '1';
    }
    
    print '0';
?>