<?php

    $query = "INSERT INTO clientes (razon, CUIT, nombre, domicilio, telefono, provincia, localidad, cp, contacto, pagina, correo, clave) 
        SELECT razon, CUIT, nombre, domicilio, telefono, provincia, localidad, cp, contacto, pagina, correo, clave FROM clientes_pendientes WHERE codigo = ".$_REQUEST['codigo'];

    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $query = "DELETE FROM clientes_pendientes WHERE codigo = ".$_REQUEST['codigo'];

    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    $action_message = "Se ha agregado el cliente!";

?>