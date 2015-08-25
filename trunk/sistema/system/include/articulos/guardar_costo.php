<?php
    include_once('../conexion.php');
    
    Conexion::conectar();
    
    $query = "UPDATE articulos SET costo = ".$_REQUEST['costo']." WHERE codigo = ".$_REQUEST['codigo'];
    
    if (!mysql_query($query)) {
        print '1';
    }
    
    print '0';
?>