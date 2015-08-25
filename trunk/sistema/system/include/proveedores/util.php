<?php

    function get_campos_proveedores() {
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
    
    function set_proveedores_filter($proveedores) {
        if (isset($_REQUEST['campo']) && isset($_REQUEST['busqueda'])) {
            switch ($_REQUEST['campo']) {
                case 'codigo':
                    $proveedores->set_codigo_filter($_REQUEST['busqueda']);
                    break;
                case 'razon':
                    $proveedores->set_razon_filter($_REQUEST['busqueda']);
                    break;
                case 'nombre':
                    $proveedores->set_nombre_filter($_REQUEST['busqueda']);
                    break;
                case 'domicilio':
                    $proveedores->set_domicilio_filter($_REQUEST['busqueda']);
                    break;
                case 'provincia':
                    $proveedores->set_provincia_filter($_REQUEST['busqueda']);
                    break;
                case 'localidad':
                    $proveedores->set_localidad_filter($_REQUEST['busqueda']);
                    break;
                case 'contacto':
                    $proveedores->set_contacto_filter($_REQUEST['busqueda']);
                    break;
                case 'pagina':
                    $proveedores->set_pagina_filter($_REQUEST['busqueda']);
                    break;
                case 'correo':
                    $proveedores->set_correo_filter($_REQUEST['busqueda']);
                    break;
                case 'saldo':
                    $proveedores->set_saldo_filter($_REQUEST['busqueda']);
                    break;
                case 'total':
                    $proveedores->set_total_filter($_REQUEST['busqueda']);
                    break;
            }
        }
        if (isset($_REQUEST['orden']) && isset($_REQUEST['direccion'])) {
            $proveedores->set_order($_REQUEST['orden'], $_REQUEST['direccion']);
        }
        if (isset($_REQUEST['inicio']) && isset($_REQUEST['cantidad'])) {
            $proveedores->set_limit($_REQUEST['inicio'], $_REQUEST['cantidad']);
        }
    }

?>