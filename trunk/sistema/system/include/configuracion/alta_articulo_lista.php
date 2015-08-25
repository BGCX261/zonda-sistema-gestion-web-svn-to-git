<?php

    include ('include/util.php');
    
    $Articulos = $_REQUEST['articulos'];
    
    if (!isset($Articulos)) {
        alert_msg("No se han seleccionado artículos!");
        return;
    }
    
    foreach ($Articulos as $Articulo) {
        $query = "
            INSERT INTO
                listas_precio_detalle (lista, articulo, precio) 
            VALUES (
                ".$_REQUEST['lista'].",
                ".$Articulo.",
                (SELECT costo FROM articulos WHERE codigo = ".$Articulo.")
            )";
        if (!mysql_query($query)) {
            sql_error_msg();
            return;
        }
    }
    
    if (!registrar_movimiento(53, 0)) {
        sql_error_msg();
        return;
    }
    
    success_msg("Se han agregado los artículos a la lista!");
    
?>