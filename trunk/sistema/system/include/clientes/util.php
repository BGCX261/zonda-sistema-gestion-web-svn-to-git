<?php

    function get_campos_clientes() {
        return array(
            array(
                'titulo' => 'CODIGO',
                'nombre' => 'codigo',
                'alias' => 'codigo',
                'alineacion' => 'left',
                'ancho_celda' => '4'
            ),
            array(
                'titulo' => 'RAZON SOCIAL',
                'nombre' => 'razon',
                'alias' => 'razon',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'NOMBRE',
                'nombre' => 'nombre',
                'alias' => 'nombre',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'DOMICILIO',
                'nombre' => 'domicilio',
                'alias' => 'domicilio',
                'alineacion' => 'left',
                'ancho_celda' => '6'
            ),
            array(
                'titulo' => 'TELEFONO',
                'nombre' => 'telefono',
                'alias' => 'telefono',
                'alineacion' => 'left',
                'ancho_celda' => '4'
            ),
            array(
                'titulo' => 'PROVINCIA',
                'nombre' => 'provincia',
                'alias' => 'provincia',
                'alineacion' => 'left',
                'ancho_celda' => '6'
            ),
            array(
                'titulo' => 'LOCALIDAD',
                'nombre' => 'localidad',
                'alias' => 'localidad',
                'alineacion' => 'left',
                'ancho_celda' => '6'
            ),
            array(
                'titulo' => 'CP',
                'nombre' => 'cp',
                'alias' => 'cp',
                'alineacion' => 'left',
                'ancho_celda' => '4'
            ),
            array(
                'titulo' => 'CONTACTO',
                'nombre' => 'contacto',
                'alias' => 'contacto',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'PAGINA',
                'nombre' => 'pagina',
                'alias' => 'pagina',
                'alineacion' => 'left',
                'ancho_celda' => '6'
            ),
            array(
                'titulo' => 'CORREO',
                'nombre' => 'correo',
                'alias' => 'correo',
                'alineacion' => 'right',
                'ancho_celda' => '6'
            ),
            array(
                'titulo' => 'SALDO',
                'nombre' => 'saldo',
                'alias' => 'saldo',
                'alineacion' => 'right',
                'ancho_celda' => '4'
            ),
            array(
                'titulo' => 'TOTAL',
                'nombre' => 'total',
                'alias' => 'total',
                'alineacion' => 'right',
                'ancho_celda' => '4'
            )
        );
    }
    
    function set_clientes_filter($clientes) {
        if (isset($_REQUEST['campo']) && isset($_REQUEST['busqueda'])) {
            switch ($_REQUEST['campo']) {
                case 'codigo':
                    $clientes->set_codigo_filter($_REQUEST['busqueda']);
                    break;
                case 'razon':
                    $clientes->set_razon_filter($_REQUEST['busqueda']);
                    break;
                case 'nombre':
                    $clientes->set_nombre_filter($_REQUEST['busqueda']);
                    break;
                case 'domicilio':
                    $clientes->set_domicilio_filter($_REQUEST['busqueda']);
                    break;
                case 'provincia':
                    $clientes->set_provincia_filter($_REQUEST['busqueda']);
                    break;
                case 'localidad':
                    $clientes->set_localidad_filter($_REQUEST['busqueda']);
                    break;
                case 'contacto':
                    $clientes->set_contacto_filter($_REQUEST['busqueda']);
                    break;
                case 'pagina':
                    $clientes->set_pagina_filter($_REQUEST['busqueda']);
                    break;
                case 'correo':
                    $clientes->set_correo_filter($_REQUEST['busqueda']);
                    break;
                case 'saldo':
                    $clientes->set_saldo_filter($_REQUEST['busqueda']);
                    break;
                case 'total':
                    $clientes->set_total_filter($_REQUEST['busqueda']);
                    break;
            }
        }
        if (isset($_REQUEST['orden']) && isset($_REQUEST['direccion'])) {
            $clientes->set_order($_REQUEST['orden'], $_REQUEST['direccion']);
        }
        if (isset($_REQUEST['inicio']) && isset($_REQUEST['cantidad'])) {
            $clientes->set_limit($_REQUEST['inicio'], $_REQUEST['cantidad']);
        }
    }

?>