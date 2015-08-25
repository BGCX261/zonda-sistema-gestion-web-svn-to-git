<?php
    
    $form = $_REQUEST['form'];
    
    if (strpos($form, 'categoria')) {
        include_once('include/articulos/baja_categoria.php');
    }
    elseif (strpos($form, 'marca')) {
        include_once('include/articulos/baja_marca.php');
    }
    elseif (strpos($form, 'lista_de_precios')) {
        include_once('include/articulos/baja_lista_de_precios.php');
    }
    elseif (strpos($form, 'precios')) {
        include_once('include/articulos/baja_lista_precios.php');
    }
    else {
        include_once('include/articulos/baja_articulo.php');
    }
    
?>