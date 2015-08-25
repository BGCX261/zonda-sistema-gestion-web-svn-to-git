<?php

    include_once('include/table_handler.php');
    include_once('include/tabla_generica.php');
    include_once('include/tabla.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/accion_borrar.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    include_once('include/compras/compras.php');
    include_once('include/compras/tabla_compras.php');
    include_once('include/proveedores/proveedores.php');
    include_once('include/fondos/fondos.php');
    include_once('include/configuracion/condiciones_venta.php');
    
    $campos = array(
            array(
                'titulo' => 'CODIGO',
                'nombre' => 'codigo',
                'alias' => 'codigo',
                'alineacion' => 'left',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'FACTURA',
                'nombre' => 'factura',
                'alias' => 'factura',
                'alineacion' => 'left',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'FECHA',
                'nombre' => 'fecha',
                'alias' => 'fecha',
                'alineacion' => 'left',
                'ancho_celda' => '14'
            ),
            array(
                'titulo' => 'PROVEEDOR',
                'nombre' => 'proveedor',
                'alias' => 'proveedor',
                'alineacion' => 'left',
                'ancho_celda' => '25'
            ),
            array(
                'titulo' => 'FONDO',
                'nombre' => 'fondo',
                'alias' => 'fondo',
                'alineacion' => 'left',
                'ancho_celda' => '12'
            ),
            array(
                'titulo' => 'CONDICION',
                'nombre' => 'condicion',
                'alias' => 'condicion',
                'alineacion' => 'left',
                'ancho_celda' => '8'
            ),
            array(
                'titulo' => 'MONTO',
                'nombre' => 'monto',
                'alias' => 'monto',
                'alineacion' => 'right',
                'ancho_celda' => '8'
            ),
            array(
                'titulo' => 'SALDO',
                'nombre' => 'saldo',
                'alias' => 'saldo',
                'alineacion' => 'right',
                'ancho_celda' => '8'
            )
        );
    
    include_once('include/form_busqueda.php');
    
    print "<span>&nbsp;</span>";
    
    print '<h1>Compras realizadas</h1>';
    
    $tabla = new TablaCompras();
    
    if (isset($_REQUEST['campo']) && isset($_REQUEST['busqueda'])) {
        switch ($_REQUEST['campo']) {
            case 'codigo':
                $tabla->get_compras()->set_codigo_filter($_REQUEST['busqueda']);
                break;
            case 'factura':
                $tabla->get_compras()->set_factura_filter($_REQUEST['busqueda']);
                break;
            case 'fecha':
                $tabla->get_compras()->set_fecha_filter($_REQUEST['busqueda']);
                break;
            case 'proveedor':
                $tabla->get_compras()->set_proveedor_filter($_REQUEST['busqueda']);
                break;
            case 'fondo':
                $tabla->get_compras()->set_fondo_filter($_REQUEST['busqueda']);
                break;
            case 'condicion':
                $tabla->get_compras()->set_condicion_filter($_REQUEST['busqueda']);
                break;
            case 'monto':
                $tabla->get_compras()->set_monto_filter($_REQUEST['busqueda']);
                break;
            case 'saldo':
                $tabla->get_compras()->set_saldo_filter($_REQUEST['busqueda']);
                break;
        }
    }
    
    if (isset($_REQUEST['orden']) && isset($_REQUEST['direccion'])) {
        $tabla->get_compras()->set_order($_REQUEST['orden'], $_REQUEST['direccion']);
    }
    
    if (isset($_REQUEST['inicio']) && isset($_REQUEST['cantidad'])) {
        $tabla->get_compras()->set_limit($_REQUEST['inicio'], $_REQUEST['cantidad']);
    }
    
    $tabla->iniciar_tabla('tabla-compras');
    
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