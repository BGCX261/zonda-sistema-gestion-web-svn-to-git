<?php
    include_once('include/articulos/lista_de_precios.php');
    include_once('include/articulos/util.php');
    
    $lista = new ListaDePrecios($_REQUEST['lista']);
    
    set_lista_precios_filter($lista);
    
    $state = NULL;
    
    switch ($_REQUEST['modificacion']) {
        case 'porcentaje':
            $state = $lista->update_precio_porcentaje($_REQUEST['valor']);
            break;
        case 'valor':
            $state = $lista->update_precio_valor($_REQUEST['valor']);
            break;
        case 'precio':
            $state = $lista->update_precio($_REQUEST['valor']);
    }

    if (!$state) {
        $action_message = mysql_error();
        return;
    }

    $action_message = 'Se han modificado los precios';
?>