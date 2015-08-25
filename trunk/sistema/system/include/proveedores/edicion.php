<?php

    $ImagenSubida = FALSE;
    
    if (isset($_FILES["imagen"])) {
        if (is_uploaded_file($_FILES["imagen"]["tmp_name"])) {
            if (copy($_FILES["imagen"]["tmp_name"], "images/proveedores/".$_FILES["imagen"]["name"])) {
                $ImagenSubida = TRUE;
            }
        }
    }
    
    $query = "
        UPDATE
            proveedores
        SET
            razon = '".$_REQUEST['razon']."',
            cuit = '".$_REQUEST['cuit']."',
            nombre = '".$_REQUEST['nombre']."',
            domicilio = '".htmlspecialchars(addslashes($_REQUEST['domicilio']))."',
            telefono = '".$_REQUEST['telefono']."',
            provincia = ".$_REQUEST['provincia'].",
            localidad = ".$_REQUEST['localidad'].",
            cp = '".$_REQUEST['cp']."',
            contacto = '".$_REQUEST['contacto']."',
            pagina = '".$_REQUEST['pagina']."',
            correo = '".$_REQUEST['correo']."'";
    
    if ($ImagenSubida) {
        $query .= ", imagen = 'images/proveedores/".$_FILES["imagen"]["name"]."'";
    }
    
    $query .= " WHERE codigo = ".$_REQUEST['codigo-original'] ;
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha editado el registro de proveedor!";
    
?>