<?php

    include_once('include/table_handler.php');
    include_once('include/tabla_generica.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/accion_pagar.php');
    include_once('include/compras/compras.php');
    include_once('include/proveedores/proveedores.php');
    include_once('include/proveedores/facturas_pagar.php');
    include_once('include/proveedores/tabla_facturas_pagar.php');
    
    $tabla = new TablaFacturasPagar();
    
    if ($tabla->get_count() > 0) {
    
        $campos = array(
            array(
                'titulo' => 'CODIGO',
                'nombre' => 'codigo',
                'alias' => 'Código',
                'alineacion' => 'left',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'FACTURA',
                'nombre' => 'factura',
                'alias' => 'Factura',
                'alineacion' => 'left',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'FECHA',
                'nombre' => 'fecha',
                'alias' => 'Fecha',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'PROVEEDOR',
                'nombre' => 'proveedor',
                'alias' => 'Proveedor',
                'alineacion' => 'left',
                'ancho_celda' => '40'
            ),
            array(
                'titulo' => 'MONTO',
                'nombre' => 'monto',
                'alias' => 'Monto',
                'alineacion' => 'right',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'SALDO',
                'nombre' => 'saldo',
                'alias' => 'Saldo',
                'alineacion' => 'right',
                'ancho_celda' => '10'
            )
        );

        include_once('include/form_busqueda.php');

        print '<h1>Facturas por pagar</h1>';
    
        if (isset($_REQUEST['campo']) && isset($_REQUEST['busqueda'])) {
            switch ($_REQUEST['campo']) {
                case 'codigo':
                    $tabla->get_facturas()->set_codigo_filter($_REQUEST['busqueda']);
                    break;
                case 'factura':
                    $tabla->get_facturas()->set_factura_filter($_REQUEST['busqueda']);
                    break;
                case 'fecha':
                    $tabla->get_facturas()->set_fecha_filter($_REQUEST['busqueda']);
                    break;
                case 'proveedor':
                    $tabla->get_facturas()->set_proveedor_filter($_REQUEST['busqueda']);
                    break;
                case 'monto':
                    $tabla->get_facturas()->set_monto_filter($_REQUEST['busqueda']);
                    break;
                case 'saldo':
                    $tabla->get_facturas()->set_saldo_filter($_REQUEST['busqueda']);
                    break;
            }
        }
        if (isset($_REQUEST['orden']) && isset($_REQUEST['direccion'])) {
            $tabla->get_facturas()->set_order($_REQUEST['orden'], $_REQUEST['direccion']);
        }
        if (isset($_REQUEST['inicio']) && isset($_REQUEST['cantidad'])) {
            $tabla->get_facturas()->set_limit($_REQUEST['inicio'], $_REQUEST['cantidad']);
        }

        $tabla->iniciar_tabla('tabla-facturas');

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
    
    }
    else {
        print '<h2>No hay compras pendientes de pago</h2>';
    }
    
?>