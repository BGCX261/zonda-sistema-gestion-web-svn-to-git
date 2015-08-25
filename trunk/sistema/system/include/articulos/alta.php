<?php

    $query = "SELECT * FROM articulos WHERE codigo = ".$_REQUEST['codigo'];
    
    $result = mysql_query($query);
    
    if (mysql_num_rows($result) > 0) {
        $action_message = "El código ya ha sido utilizado";
        return;
    }
    
    include_once("include/image_handler.php");

    $image = new ImageHandler("images/articulos/");
    
    $ImagenSubida = $image->load();
    
    $query = "
        INSERT INTO articulos (
            codigo,
            descripcion,
            categoria,
            proveedor,
            marca,
            costo,
            precio,
            alicuota,";
    
    if ($ImagenSubida) {
        $query .= "imagen,";
    }
            
    $query .= " resumen, existencia) VALUES (
            '".$_REQUEST['codigo']."',
            '".htmlspecialchars(addslashes($_REQUEST['descripcion']))."',
            ".$_REQUEST['categoria'].",
            ".$_REQUEST['proveedor'].",
            ".$_REQUEST['marca'].",
            ".$_REQUEST['costo'].",
            ".$_REQUEST['precio'].",
            ".$_REQUEST['alicuota'].",";
    
    if ($ImagenSubida) {
        $query .= "'".$ImagenSubida."',";
    }
    
    $query .= "'".htmlspecialchars(addslashes($_REQUEST['resumen']))."', 0)";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha agregado el artículo";
    
?>