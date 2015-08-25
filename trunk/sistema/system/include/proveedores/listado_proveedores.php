<?php

    include_once('include/table_handler.php');
    include_once('include/tabla_generica.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/configuracion/provincias.php');
    include_once('include/configuracion/localidades.php');
    include_once('include/proveedores/tabla_proveedores.php');
    include_once('include/proveedores/proveedores.php');
    include_once('include/proveedores/util.php');
    
    $campos = get_campos_proveedores();
    
    include_once('include/form_campos.php');
    include_once('include/form_busqueda.php');
    
    $tabla = new TablaProveedores();
    
    $tabla->iniciar_tabla('tabla-proveedores');
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    set_proveedores_filter($tabla->get_proveedores());
    
    $tabla->show();
    
    $tabla->cerrar_tabla();
    
    $paginador = new Paginador();
    
    $paginador->set_total($tabla->get_count());
    
    $paginador->set_interval($_REQUEST['cantidad']);
    
    $url = new UrlUtil();
    
    $paginador->set_url($url->get_uri());
    
    $paginador->show();
    
?>