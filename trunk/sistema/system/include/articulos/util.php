<?php

    function get_campos_articulos() {
        return array(
            array(
                'titulo' => 'CODIGO',
                'nombre' => 'codigo',
                'alias' => 'codigo',
                'alineacion' => 'left',
                'ancho_celda' => '5'
            ),
            array(
                'titulo' => 'DESCRIPCION',
                'nombre' => 'descripcion',
                'alias' => 'descripcion',
                'alineacion' => 'left',
                'ancho_celda' => '25'
            ),
            array(
                'titulo' => 'CATEGORIA',
                'nombre' => 'categoria',
                'alias' => 'categoria',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'PROVEEDOR',
                'nombre' => 'proveedor',
                'alias' => 'proveedor',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'MARCA',
                'nombre' => 'marca',
                'alias' => 'marca',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'COSTO',
                'nombre' => 'costo',
                'alias' => 'costo',
                'alineacion' => 'right',
                'ancho_celda' => '5'
            ),
            array(
                'titulo' => 'PRECIO',
                'nombre' => 'precio',
                'alias' => 'precio',
                'alineacion' => 'right',
                'ancho_celda' => '5'
            ),
            array(
                'titulo' => 'ALICUOTA',
                'nombre' => 'alicuota',
                'alias' => 'alicuota',
                'alineacion' => 'right',
                'ancho_celda' => '5'
            ),
            array(
                'titulo' => 'EXISTENCIA',
                'nombre' => 'existencia',
                'alias' => 'existencia',
                'alineacion' => 'right',
                'ancho_celda' => '5'
            )
        );
    }
    
    function set_articulos_filter($articulos) {
        if (isset($_REQUEST['campo']) && isset($_REQUEST['busqueda'])) {
            switch ($_REQUEST['campo']) {
                case 'codigo':
                    $articulos->set_codigo_filter($_REQUEST['busqueda']);
                    break;
                case 'descripcion':
                    $articulos->set_descripcion_filter($_REQUEST['busqueda']);
                    break;
                case 'categoria':
                    $articulos->set_categoria_filter($_REQUEST['busqueda']);
                    break;
                case 'proveedor':
                    $articulos->set_proveedor_filter($_REQUEST['busqueda']);
                    break;
                case 'marca':
                    $articulos->set_marca_filter($_REQUEST['busqueda']);
                    break;
                case 'costo':
                    $articulos->set_costo_filter($_REQUEST['busqueda']);
                    break;
                case 'precio':
                    $articulos->set_precio_filter($_REQUEST['busqueda']);
                    break;
                case 'alicuota':
                    $articulos->set_alicuota_filter($_REQUEST['busqueda']);
                    break;
                case 'existencia':
                    $articulos->set_existencia_filter($_REQUEST['busqueda']);
                    break;
            }
        }
        if (isset($_REQUEST['orden']) && isset($_REQUEST['direccion'])) {
            $articulos->set_order($_REQUEST['orden'], $_REQUEST['direccion']);
        }
        if (isset($_REQUEST['inicio']) && isset($_REQUEST['cantidad'])) {
            $articulos->set_limit($_REQUEST['inicio'], $_REQUEST['cantidad']);
        }
    }
    
    function set_lista_precios_filter($lista) {
        if (isset($_REQUEST['campo']) && isset($_REQUEST['busqueda'])) {
            switch ($_REQUEST['campo']) {
                case 'articulos.codigo':
                    $lista->set_codigo_filter($_REQUEST['busqueda']);
                    break;
                case 'articulos.descripcion':
                    $lista->set_descripcion_filter($_REQUEST['busqueda']);
                    break;
                case 'articulos.categoria':
                    $lista->set_categoria_filter($_REQUEST['busqueda']);
                    break;
                case 'articulos.proveedor':
                    $lista->set_proveedor_filter($_REQUEST['busqueda']);
                    break;
                case 'articulos.marca':
                    $lista->set_marca_filter($_REQUEST['busqueda']);
                    break;
                case 'articulos.costo':
                    $lista->set_costo_filter($_REQUEST['busqueda']);
                    break;
                case 'listas_precios_detalle.precio':
                    $lista->set_precio_filter($_REQUEST['busqueda']);
                    break;
            }
        }
        if (isset($_REQUEST['orden']) && isset($_REQUEST['direccion'])) {
            $lista->set_order($_REQUEST['orden'], $_REQUEST['direccion']);
        }
        if (isset($_REQUEST['inicio']) && isset($_REQUEST['cantidad'])) {
            $lista->set_limit($_REQUEST['inicio'], $_REQUEST['cantidad']);
        }
    }

?>