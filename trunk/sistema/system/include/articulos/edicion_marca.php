<?php

    include_once("include/image_handler.php");

    $image = new ImageHandler("images/marcas/");
    
    $ImagenSubida = $image->load();

    $query = "UPDATE marcas SET 
            codigo = ".$_REQUEST['codigo'].",
            descripcion = '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."' ";
    
    if ($ImagenSubida) {
        $query .= ", imagen = '".$ImagenSubida."'";
    }
    
    $query .= " WHERE codigo = ".$_REQUEST['codigo-original'];
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha editado la marca';
    
?>