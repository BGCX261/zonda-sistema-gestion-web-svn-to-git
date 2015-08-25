<?php

    include_once('include/table_handler.php');
    include_once('include/tabla_generica.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/paginador.php');
    include_once('include/url_util.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/accion_cobrar_cuota.php');
    include_once('include/clientes/agenda_pagos.php');
    include_once('include/clientes/tabla_agenda_pagos.php');
    
    $campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'ventas.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '10'
        ),
        array(
            'titulo' => 'CLIENTE',
            'nombre' => 'clientes.razon',
            'alias' => 'Cliente',
            'alineacion' => 'left',
            'ancho_celda' => '25'
        ),
        array(
            'titulo' => 'CONDICION DE VENTA',
            'nombre' => 'condiciones_venta.descripcion',
            'alias' => 'Condición de venta',
            'alineacion' => 'left',
            'ancho_celda' => '15'
        ),
        array(
            'titulo' => 'EMISION',
            'nombre' => 'ventas.fecha',
            'alias' => 'Emisión',
            'alineacion' => 'left',
            'ancho_celda' => '12'
        ),
        array(
            'titulo' => 'CUOTAS PAGAS',
            'nombre' => 'cuotas',
            'alias' => 'Cuotas pagas',
            'alineacion' => 'left',
            'ancho_celda' => '9'
        ),
        array(
            'titulo' => 'PROXIMO VENCIMIENTO',
            'nombre' => 'vencimiento',
            'alias' => 'Vencimiento',
            'alineacion' => 'left',
            'ancho_celda' => '10'
        ),
        array(
            'titulo' => 'ESTADO',
            'nombre' => 'estado',
            'alias' => 'Estado',
            'alineacion' => 'center',
            'ancho_celda' => '5'
        ),
        array(
            'titulo' => 'MONTO',
            'nombre' => 'ventas.monto',
            'alias' => 'Monto',
            'alineacion' => 'right',
            'ancho_celda' => '7'
        ),
        array(
            'titulo' => 'SALDO',
            'nombre' => 'ventas.saldo',
            'alias' => 'Saldo',
            'alineacion' => 'right',
            'ancho_celda' => '7'
        )
    );
    
    print '<h1>Agenda de pagos de clientes</h1>';
    
    $tabla = new TablaAgendaPagos();
    
    $tabla->iniciar_tabla('tabla-facturas');
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $tabla->show();
    
    $tabla->cerrar_tabla();
    
    $paginador = new Paginador();
    
    $paginador->set_total($tabla->get_facturas()->get_count());
    
    $paginador->set_interval($_REQUEST['cantidad']);
    
    $url = new UrlUtil();
    
    $paginador->set_url($url->get_uri());
    
    $paginador->show();
    
?>