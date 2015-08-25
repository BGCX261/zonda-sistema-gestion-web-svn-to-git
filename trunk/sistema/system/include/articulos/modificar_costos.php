<?php

    include_once('include/util.php');
    
    switch($_REQUEST['filtro']) {
        
        case 'ultimo':
            $return = mysql_query("SELECT DISTINCT articulo FROM compras_detalle");
            if (!$return) {
                $action_message = mysql_error();
                return;
            }
            while ($Articulos = mysql_fetch_array($return)) {
                $query = "SELECT precio FROM compras_detalle WHERE articulo = ". $Articulos[0] ." ORDER BY codigo DESC LIMIT 0 , 1";
                $return1 = mysql_query($query);
                if (!$return1) {
                   $action_message = mysql_error();
                   return;
                }
                $Precio = mysql_fetch_array($return1);
                $return2 = mysql_query("UPDATE articulos SET costo = ". $Precio[0] ." WHERE codigo = ". $Articulos[0]);
                if (!$return2) {
                   $action_message = mysql_error();
                   return;
                }
            }
            break;
            
        case 'mayor':
            $return = mysql_query("SELECT DISTINCT articulo FROM compras_detalle");
            if (!$return) {
                $action_message = mysql_error();
                return;
            }
            while ($Articulos = mysql_fetch_array($return)) {
                $query = "SELECT MAX(precio) FROM compras_detalle WHERE articulo = ". $Articulos[0];
                $return1 = mysql_query($query);
                if (!$return1) {
                    $action_message = mysql_error();
                    return;
                }
                $Precio = mysql_fetch_array($return1);
                $return2 = mysql_query("UPDATE articulos SET costo = ". $Precio[0] ." WHERE codigo = ". $Articulos[0]);
                if (!$return2) {
                    $action_message = mysql_error();
                    return;
                }
            }
            break;
            
        case 'menor':
            $return = mysql_query("SELECT DISTINCT articulo FROM compras_detalle");
            if (!$return) {
                $action_message = mysql_error();
                return;
            }
            while ($Articulos = mysql_fetch_array($return)) {
                $query = "SELECT MIN(precio) FROM compras_detalle WHERE articulo = ". $Articulos[0];
                $return1 = mysql_query($query);
                if (!$return1) {
                    $action_message = mysql_error();
                    return;
                }
                $Precio = mysql_fetch_array($return1);
                $return2 = mysql_query("UPDATE articulos SET costo = ". $Precio[0] ." WHERE codigo = ". $Articulos[0]);
                if (!$return2) {
                    $action_message = mysql_error();
                    return;
                }
            }
            break;
            
        case 'promedio':
            $return = mysql_query("SELECT DISTINCT articulo FROM compras_detalle");
            if (!$return) {
                $action_message = mysql_error();
                return;
            }
            while ($Articulos = mysql_fetch_array($return)) {
                $query = "SELECT AVG(precio) FROM compras_detalle WHERE articulo = ". $Articulos[0];
                $return1 = mysql_query($query);
                if (!$return1) {
                    $action_message = mysql_error();
                    return;
                }
                $Precio = mysql_fetch_array($return1);
                $return2 = mysql_query("UPDATE articulos SET costo = ". $Precio[0] ." WHERE codigo = ". $Articulos[0]);
                if (!$return2) {
                    $action_message = mysql_error();
                    return;
                }
            }
            break;
            
    }
    
    if (!registrar_movimiento(56, 0)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se han modificado los costos";
    
?>