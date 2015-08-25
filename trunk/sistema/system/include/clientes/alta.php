<?php

    $query = "SELECT * FROM clientes WHERE codigo = ".$_REQUEST['codigo'];
    
    $result = mysql_query($query);
    
    if (mysql_num_rows($result) > 0) {
        $action_message = "El código ya ha sido utilizado";
        return;
    }
    
    $ImagenSubida = FALSE;
    
    if (isset($_FILES["imagen"])) {
        if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
            if (copy($_FILES["imagen"]["tmp_name"], "images/clientes/".$_FILES["imagen"]["name"])) {
                $ImagenSubida = TRUE;
            }
        }
    }

    $query = "
        INSERT INTO clientes (
                codigo,
                razon,
                cuit,
                nombre,
                domicilio,
                telefono,
                provincia,
                localidad,
                cp,
                contacto,
                pagina,
                correo,
                lista";
    
    if ($ImagenSubida) {
        $query .= ", imagen";
    }
            
    $query .= ")
            VALUES (
                ".$_REQUEST['codigo'].",
                '".htmlspecialchars(addslashes($_REQUEST['razon']))."',
                '".$_REQUEST['cuit']."',
                '".htmlspecialchars(addslashes($_REQUEST['nombre']))."',
                '".htmlspecialchars(addslashes($_REQUEST['domicilio']))."',
                '".$_REQUEST['telefono']."',
                ".$_REQUEST['provincia'].",
                ".$_REQUEST['localidad'].",
                '".$_REQUEST['cp']."',
                '".$_REQUEST['contacto']."',
                '".$_REQUEST['pagina']."',
                '".$_REQUEST['correo']."',
                ".$_REQUEST['lista'];
    
    if ($ImagenSubida) {
        $query .= ", 'images/clientes/".$_FILES["imagen"]["name"]."',";
    }
    
    $query .= ")";

    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }

    $action_message = "Se ha agregado el cliente!";
    
?>