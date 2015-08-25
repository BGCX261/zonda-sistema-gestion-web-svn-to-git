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
    include_once('include/configuracion/condiciones_venta.php');
    include_once('include/configuracion/tabla_condiciones_venta.php');
    
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
                'ancho_celda' => '40'
            ),
            array(
                'titulo' => 'CUOTAS',
                'nombre' => 'coutas',
                'alineacion' => 'right',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'PLAZO',
                'nombre' => 'plazo',
                'alineacion' => 'right',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'INTERVALO',
                'nombre' => 'intervalo',
                'alineacion' => 'left',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'INTERES',
                'nombre' => 'interes',
                'alineacion' => 'right',
                'ancho_celda' => '10'
            )
        );
    
    print '<h1>Administraci&oacute;n de condiciones de venta</h1>';
    
    $boton_nuevo = new EnlaceFlat('agregar-condicion', 'Nueva condición de venta', '?include=configuracion&form=form_edicion_condicion&type=alta', 'agregar-item');
    $boton_nuevo->show();
    
    $tabla = new TablaCondicionesVenta();
    $tabla->set_encabezado(new Encabezado($campos));
    $tabla->iniciar_tabla('tabla-condiciones');
    $tabla->show();
    $tabla->cerrar_tabla();
    
?>