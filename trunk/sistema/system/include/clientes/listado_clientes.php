<?php

    include_once('include/table_handler.php');
    include_once('include/clientes/util.php');
    include_once('include/clientes/clientes.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/clientes/tabla_clientes.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    
    $campos = get_campos_clientes();
    
    include_once('include/form_campos.php');
    include_once('include/form_busqueda.php');
    
    print '<table name="tabla-clientes" class="ui-widget tabla-datos">';
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $clientes = new Clientes();
    
    set_clientes_filter($clientes);
    
    $tabla = new TablaClientes();
    
    $tabla->show($clientes->get_result());
    
    print '</table>';
    
    $paginador = new Paginador();
    
    $paginador->set_total($clientes->get_count());
    
    $paginador->set_interval($_REQUEST['cantidad']);
    
    $url = new UrlUtil();
    
    $paginador->set_url($url->get_uri());
    
    $paginador->show();
    
?>