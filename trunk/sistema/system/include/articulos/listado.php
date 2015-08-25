<?php

    include_once('include/table_handler.php');
    include_once('include/articulos/util.php');
    include_once('include/articulos/articulos.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/articulos/tabla_articulos.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    
    $campos = get_campos_articulos();
    
    include_once('include/articulos/form_campos_articulos.php');
    include_once('include/form_busqueda.php');
    
    print '<table name="tabla-articulos" class="ui-widget tabla-datos">';
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $articulos = new Articulos();
    
    set_articulos_filter($articulos);
    
    $tabla = new TablaArticulos();
    
    $tabla->show($articulos->get_articulos());
    
    print '</table>';
    
    $paginador = new Paginador();
    
    $paginador->set_total($articulos->get_count());
    
    $paginador->set_interval($_REQUEST['cantidad']);
    
    $url = new UrlUtil();
    
    $paginador->set_url($url->get_uri());
    
    $paginador->show();
    
?>