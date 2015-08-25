<?php
    include_once('include/conexion.php');
    
    Conexion::conectar();

    $query = "
        INSERT INTO
            listas_precios_detalle (lista, articulo, precio) 
        SELECT
            ".$_REQUEST['lista'].",
            codigo,
            precio
        FROM
            articulos
        WHERE
            codigo NOT IN (SELECT articulo FROM listas_precios_detalle WHERE lista = ".$_REQUEST['lista'].")";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se han agregado los artículos a la lista';
?>