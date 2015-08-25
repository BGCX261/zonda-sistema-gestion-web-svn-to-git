<?php

    include_once("include/image_handler.php");

    $image = new ImageHandler("images/categorias/");
    
    $ImagenSubida = $image->load();
    
    $query = "INSERT INTO categorias (
            codigo, 
            descripcion, 
            padre ";
    
    if ($ImagenSubida) {
        $query .= ", imagen";
    }
    
    $query .= ") VALUES (
            ".$_REQUEST['codigo'].",
            '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."',
            ".$_REQUEST['padre'];
    
    if ($ImagenSubida) {
        $query .= ", '".$ImagenSubida."'";
    }
    
    $query .= ")";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha agregado la categoría';
    
?>