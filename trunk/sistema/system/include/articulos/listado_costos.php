<?php 
    
    include_once('include/encabezado_tabla.php');
    include_once('include/articulos/costos.php');
    include_once('include/articulos/tabla_costos.php');
    include_once('include/articulos/util.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    
    $campos = array(
        array(
            'nombre' => 'codigo',
            'alias' => 'codigo'
        ),
        array(
            'nombre' => 'descripcion',
            'alias' => 'descripcion'
        ),
        array(
            'nombre' => 'categoria',
            'alias' => 'categoria'
        ),
        array(
            'nombre' => 'proveedor',
            'alias' => 'proveedor'
        ),
        array(
            'nombre' => 'marca',
            'alias' => 'marca'
        ),
        array(
            'nombre' => 'costo',
            'alias' => 'costo'
        )
    );
    
    include_once('include/form_busqueda.php');
    //include_once('include/articulos/form_precios_costos.php');
    
    print "<span>&nbsp;</span>";
    
    print '<h1>Administraci&oacute;n de costos</h1>';
    
    print '<table id="tabla-costos" class="ui-widget tabla-datos">';

    $campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'codigo',
            'alineacion' => 'left',
            'ancho_celda' => '20'
        ),
        array(
            'titulo' => 'DESCRIPCION',
            'nombre' => 'descripcion',
            'alineacion' => 'left',
            'ancho_celda' => '60'
        ),
        array(
            'titulo' => 'COSTO',
            'nombre' => 'costo',
            'alineacion' => 'center',
            'ancho_celda' => '15'
        )
    );
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $costos = new Costos();
    
    set_articulos_filter($costos);
    
    $tabla = new TablaCostos();
    
    $tabla->show($costos->get_lista_articulos());
    
    print '</table>';
    
    $paginador = new Paginador();
    
    $paginador->set_total($costos->get_count());
    
    $paginador->set_interval($_REQUEST['cantidad']);
    
    $url = new UrlUtil();
    
    $paginador->set_url($url->get_uri());
    
    $paginador->show();
    
?>