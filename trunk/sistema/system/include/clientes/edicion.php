<?php

    include_once("include/image_handler.php");

    $image = new ImageHandler("images/clientes/");
    
    $ImagenSubida = $image->load();
    
    $query = "
        UPDATE
            clientes
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
            correo = '".$_REQUEST['correo']."',
            lista = ".$_REQUEST['lista'];
    
    if ($ImagenSubida) {
        $query .= ", imagen = '".$ImagenSubida."'";
    }
    
    $query .= " WHERE codigo = ".$_REQUEST['codigo-original'] ;
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha editado el registro de cliente!";
    
?>