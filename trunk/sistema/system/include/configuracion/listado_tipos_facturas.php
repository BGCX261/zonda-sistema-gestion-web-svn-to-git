<?php

    include_once('include/table_handler.php');
    include_once('include/enlace.php');
    include_once('include/enlace_flat.php');
    include_once('include/encabezado.php');
    include_once('include/tabla_generica.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/formulario.php');
    include_once('include/campo.php');
    include_once('include/campo_oculto.php');
    include_once('include/boton.php');
    include_once('include/boton_flat.php');
    include_once('include/configuracion/tipos_facturas.php');
    include_once('include/configuracion/tabla_tipos_facturas.php');
    
    $campos = array(
            array(
                'titulo' => 'CODIGO',
                'nombre' => 'codigo',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'DESCRIPCION',
                'nombre' => 'descripcion',
                'alineacion' => 'left',
                'ancho_celda' => '50'
            ),
            array(
                'titulo' => 'IVA',
                'nombre' => 'iva',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            ),
            array(
                'titulo' => 'DISCRIMINA',
                'nombre' => 'discrimina',
                'alineacion' => 'left',
                'ancho_celda' => '15'
            )
        );
    
    print '<h1>Administraci&oacute;n de tipos de facturas</h1>';
    
    $boton_nuevo = new EnlaceFlat('agregar-tipo', 'Nuevo tipo de factura', '?include=configuracion&form=form_edicion_tipo_factura&type=alta', 'agregar-item');
    $boton_nuevo->show();
    
    $tabla = new TablaTiposFacturas();
    $tabla->set_encabezado(new Encabezado($campos));
    $tabla->iniciar_tabla('tabla-tipos');
    $tabla->show();
    $tabla->cerrar_tabla();
    
?>