<?php

    $query = "
        INSERT INTO
            listas_precios (
                codigo,
                descripcion,
                actualizacion
            ) VALUES (
                ".$_REQUEST['codigo'].",
                '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."',
                NOW()
            )";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $query = "INSERT INTO listas_precios_detalle (lista, articulo, precio) SELECT ".$_REQUEST['codigo'].", codigo, precio FROM articulos";

    if (!mysql_query($query)) {
       $action_message = mysql_error();
       return;
    }
    
    $action_message = 'Se ha agregado la lista de precios';
    
?>