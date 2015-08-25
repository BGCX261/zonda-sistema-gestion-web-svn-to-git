<?php

    include_once("include/image_handler.php");

    $image = new ImageHandler("images/marcas/");
    
    $ImagenSubida = $image->load();
    
    $query = "
        INSERT INTO marcas (
            codigo, 
            descripcion";
    
    if ($ImagenSubida) {
        $query .= ", imagen";
    }
    
    $query .= ") VALUES (
            ".$_REQUEST['codigo'].",
            '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."'";
    
    if ($ImagenSubida) {
        $query .= ", '".$ImagenSubida."'";
    }
    
    $query .= ")";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha agregado la marca';
    
    
?>