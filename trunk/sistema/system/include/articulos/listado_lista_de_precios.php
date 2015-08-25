<?php 
    
    include_once('include/enlace.php');
    include_once('include/enlace_flat.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/articulos/lista_de_precios.php');
    include_once('include/articulos/tabla_lista_de_precios.php');
    include_once('include/articulos/util.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    
    $campos = array(
        array(
            'nombre' => 'articulos.codigo',
            'alias' => 'codigo'
        ),
        array(
            'nombre' => 'articulos.descripcion',
            'alias' => 'descripcion'
        ),
        array(
            'nombre' => 'articulos.categoria',
            'alias' => 'categoria'
        ),
        array(
            'nombre' => 'articulos.proveedor',
            'alias' => 'proveedor'
        ),
        array(
            'nombre' => 'articulos.marca',
            'alias' => 'marca'
        ),
        array(
            'nombre' => 'articulos.costo',
            'alias' => 'costo'
        ),
        array(
            'nombre' => 'listas_precios_detalle.precio',
            'alias' => 'precio'
        )
    );
    
    include_once('include/form_busqueda.php');
    include_once('include/articulos/form_precios_costos.php');
    
    print "<span>&nbsp;</span>";
    
    print '<h1>Administraci&oacute;n de lista de precios</h1>';
    
    $boton_agregar = new EnlaceFlat('agregar-articulo', 'Agregar artículos a la lista', '?include=articulos&form=listado_articulos_sin_lista&inicio=0&cantidad=25&orden=codigo&direccion=ASC&lista='.$_REQUEST['lista'].'', 'agregar-item');
    
    $url = new UrlUtil();
    
    $boton_agregar_todo = new EnlaceFlat('agregar-articulo', 'Agregar todos los artículos', $url->get_uri().'&action=alta_articulo_lista_todos', 'agregar-item');
    
    $boton_limpiar = new EnlaceFlat('agregar-articulo', 'Eliminar todos los artículos', $url->get_uri().'&action=limpiar_lista_de_precios', 'borrar-item');
    
    $boton_agregar->show();
    
    $boton_agregar_todo->show();
    
    $boton_limpiar->show();
    
    print '<table id="tabla-lista-de-precios" class="ui-widget tabla-datos">';

    $campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'articulos.codigo',
            'alineacion' => 'left',
            'ancho_celda' => '15'
        ),
        array(
            'titulo' => 'DESCRIPCION',
            'nombre' => 'articulos.descripcion',
            'alineacion' => 'left',
            'ancho_celda' => '50'
        ),
        array(
            'titulo' => 'COSTO',
            'nombre' => 'articulos.costo',
            'alineacion' => 'right',
            'ancho_celda' => '15'
        ),
        array(
            'titulo' => 'PRECIO',
            'nombre' => 'listas_precio_detalle.precio',
            'alineacion' => 'center',
            'ancho_celda' => '15'
        )
    );
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $lista = new ListaDePrecios($_REQUEST['lista']);
    
    set_lista_precios_filter($lista);
    
    $tabla = new TablaListaDePrecios();
    
    $tabla->show($lista->get_lista_articulos());
    
    print '</table>';
    
    $paginador = new Paginador();
    
    $paginador->set_total($lista->get_count());
    
    $paginador->set_interval($_REQUEST['cantidad']);
    
    $paginador->set_url($url->get_uri());
    
    $paginador->show();
    
?>