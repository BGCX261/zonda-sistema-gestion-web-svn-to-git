<?php
    include_once('../conexion.php');
    
    Conexion::conectar();

    $query = "
        INSERT INTO
            listas_precios_detalle (lista, articulo, precio) 
        VALUES (
            ".$_REQUEST['lista'].",
            ".$_REQUEST['codigo'].",
            ".$_REQUEST['precio']."
        )";
    
    if (!mysql_query($query)) {
        print '1';
        return;
    }
    
    print '0';
?>