<?php 
    
    include_once('include/boton.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/articulos/articulos_sin_lista_de_precios.php');
    include_once('include/articulos/tabla_articulos_sin_lista_de_precios.php');
    include_once('include/articulos/util.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    include_once('include/formatter.php');
    
    $campos = array(
        array(
            'titulo' => '',
            'nombre' => '',
            'alias' => '',
            'alineacion' => 'center',
            'ancho_celda' => '10'
        ),
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'codigo',
            'alias' => 'codigo',
            'alineacion' => 'left',
            'ancho_celda' => '20'
        ),
        array(
            'titulo' => 'DESCRIPCION',
            'nombre' => 'descripcion',
            'alias' => 'descripcion',
            'alineacion' => 'left',
            'ancho_celda' => '55'
        ),
        array(
            'titulo' => 'PRECIO',
            'nombre' => 'precio',
            'alias' => '',
            'alineacion' => 'left',
            'ancho_celda' => '10'
        )
    );
    
    include_once('include/form_busqueda.php');
    
    print "<span>&nbsp;</span>";
    
    print '<h1>Agregar artículos a la lista de precios</h1>';
    
    print '<table name="tabla-articulos-sin-lista" class="ui-widget tabla-datos">';

    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $lista = new ArticulosSinListaDePrecios($_REQUEST['lista']);
    
    set_articulos_filter($lista);
    
    $tabla = new TablaArticulosSinListaDePrecios($lista);
    
    $tabla->show();
    
    print '</table>';
    
    $paginador = new Paginador();
    
    $paginador->set_total($lista->get_count());
    
    $paginador->set_interval($_REQUEST['cantidad']);
    
    $url = new UrlUtil();
    
    $paginador->set_url($url->get_uri());
    
    $paginador->show();
    
?>