<?php

    include_once("include/image_handler.php");

    $image = new ImageHandler("images/articulos/");
    
    $ImagenSubida = $image->load();
    
    $query = "
        UPDATE
            articulos
        SET
            codigo = ".$_REQUEST['codigo'].",
            descripcion = '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."',
            categoria = ".$_REQUEST['categoria'].",
            proveedor = ".$_REQUEST['proveedor'].",
            marca = ".$_REQUEST['marca'].",
            costo = ".$_REQUEST['costo'].",
            precio = ".$_REQUEST['precio'].",
            alicuota = ".$_REQUEST['alicuota'];
    
    if ($ImagenSubida) {
        $query .= ", imagen = '".$ImagenSubida."'";
    }
    
    $query .= ", resumen = '".htmlspecialchars(addslashes($_REQUEST['resumen']))."'";
        
    $query .= " WHERE codigo = ".$_REQUEST['codigo-original'] ;
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = 'Se ha editado el artículo';
    
?>