<?php

    if (mysql_num_rows(mysql_query("SELECT * FROM empresa")) < 1) {
        mysql_query("INSERT INTO empresa (codigo) VALUES (1)");
    }

    include_once("include/image_handler.php");

    $image = new ImageHandler("images/empresa/");
    
    $ImagenSubida = $image->load();
    
    $query = "
        UPDATE
            empresa
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
        $query .= ", imagen = '".$ImagenSubida."'";
    }
    
    $query .= " WHERE codigo = 1";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha actualizado la información de la empresa!";
    
?>