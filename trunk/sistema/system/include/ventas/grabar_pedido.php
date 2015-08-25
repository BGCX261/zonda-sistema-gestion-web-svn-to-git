<?php
    
    if (!isset($_SESSION['lista_articulos']) || $_SESSION['lista_articulos']->num_items() < 1) {
        $action_message = "No hay artículos en la lista!";
        return;
    }
    
    if (!isset($_REQUEST['cliente']) || $_REQUEST['cliente'] < 1) {
        $action_message = "Debe ingresar los datos del pedido!";
        return;
    }
    
    /*
     * INGRESAR EL REGISTRO DE PEDIDO:
     */
    $query = "
        INSERT INTO pedidos (
            fecha,
            cliente
        ) VALUES (
            now(),
            ".$_REQUEST['cliente']."
        )";
    
    if (!mysql_query($query)) {
        $action_message = mysql_error();
        return;
    }
    
    /*
     * OBTENER EL ID DEL REGISTRO DE PEDIDO:
     */
    $pedido = mysql_insert_id();
    
    /*
     * INGRESAR TODOS LOS ARTICULOS EN EL DETALLE DEL PEDIDO:
     */
    foreach ($_SESSION['lista_articulos']->get_items() as $articulo) {
        
        $query = "
            INSERT INTO pedidos_detalle (
                pedido,
                articulo,
                cantidad 
            ) VALUES (
                ".$pedido.", 
                ".$articulo['codigo'].", 
                ".$articulo['cantidad']."
            )";
            
        if (!mysql_query($query)) {
            $action_message = mysql_error();
            return;
        }
        
    }
    
    $action_message = "Se ha grabado el pedido!";
    
?>
