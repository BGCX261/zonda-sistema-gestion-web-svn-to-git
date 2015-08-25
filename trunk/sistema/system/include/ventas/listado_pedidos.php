<?php

    include_once('include/table_handler.php');
    include_once('include/tabla_generica.php');
    include_once('include/tabla.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/accion_borrar_procesar.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    include_once('include/ventas/pedidos.php');
    include_once('include/ventas/tabla_pedidos.php');
    include_once('include/clientes/clientes.php');
    
    $campos = array(
            array(
                'titulo' => 'CODIGO',
                'nombre' => 'codigo',
                'alias' => 'codigo',
                'alineacion' => 'left',
                'ancho_celda' => '20'
            ),
            array(
                'titulo' => 'FECHA',
                'nombre' => 'fecha',
                'alias' => 'fecha',
                'alineacion' => 'left',
                'ancho_celda' => '20'
            ),
            array(
                'titulo' => 'CLIENTE',
                'nombre' => 'cliente',
                'alias' => 'cliente',
                'alineacion' => 'left',
                'ancho_celda' => '50'
            )
        );
    
    include_once('include/form_busqueda.php');
    
    print "<span>&nbsp;</span>";
    
    print '<h1>Pedidos pendientes</h1>';
    
    $tabla = new TablaPedidos();
    
    if (isset($_REQUEST['campo']) && isset($_REQUEST['busqueda'])) {
        switch ($_REQUEST['campo']) {
            case 'codigo':
                $tabla->get_pedidos()->set_codigo_filter($_REQUEST['busqueda']);
                break;
            case 'fecha':
                $tabla->get_pedidos()->set_fecha_filter($_REQUEST['busqueda']);
                break;
            case 'cliente':
                $tabla->get_pedidos()->set_cliente_filter($_REQUEST['busqueda']);
                break;
            case 'monto':
                $tabla->get_pedidos()->set_monto_filter($_REQUEST['busqueda']);
                break;
        }
    }
    
    if (isset($_REQUEST['orden']) && isset($_REQUEST['direccion'])) {
        $tabla->get_pedidos()->set_order($_REQUEST['orden'], $_REQUEST['direccion']);
    }
    
    if (isset($_REQUEST['inicio']) && isset($_REQUEST['cantidad'])) {
        $tabla->get_pedidos()->set_limit($_REQUEST['inicio'], $_REQUEST['cantidad']);
    }
    
    $tabla->iniciar_tabla('tabla-pedidos');
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $tabla->show();
    
    $tabla->cerrar_tabla();
    
    $paginador = new Paginador();
    
    $paginador->set_total($tabla->get_count());
    
    $paginador->set_interval($_REQUEST['cantidad']);
    
    $url = new UrlUtil();
    
    $paginador->set_url($url->get_uri());
    
    $paginador->show();

?>