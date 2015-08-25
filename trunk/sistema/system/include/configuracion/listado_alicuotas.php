<?php

    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/tabla_generica.php');
    include_once('include/encabezado.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/enlace.php');
    include_once('include/enlace_flat.php');
    include_once('include/configuracion/alicuotas.php');
    include_once('include/configuracion/tabla_alicuotas.php');
    
    $campos = array(
            array(
            'titulo' => 'CODIGO',
            'nombre' => 'alicuotas.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '30'
        ),
        array(
            'titulo' => 'DESCRIPCION',
            'nombre' => 'alicuotas.descripcion',
            'alias' => 'Descripción',
            'alineacion' => 'left',
            'ancho_celda' => '50'
        ),
        array(
            'titulo' => 'ALICUOTA',
            'nombre' => 'alicuotas.alicuota',
            'alias' => 'Alícuota',
            'alineacion' => 'right',
            'ancho_celda' => '20'
        )
        );
    
    print '<h1>Administraci&oacute;n de al&iacute;cuotas</h1>';
    
    $boton_nuevo = new EnlaceFlat('agregar-alicuota', 'Nueva alícuota', '?include=configuracion&form=form_edicion_alicuotas&type=alta', 'agregar-item');
    $boton_nuevo->show();
    
    $tabla = new TablaAlicuotas();
    $tabla->set_encabezado(new Encabezado($campos));
    $tabla->iniciar_tabla('tabla-alicuotas');
    $tabla->show();
    $tabla->cerrar_tabla();
    
?>