<?php

    include_once('include/enlace.php');
    include_once('include/enlace_flat.php');
    include_once('include/encabezado.php');
    include_once('include/tabla_generica.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/configuracion/provincias.php');
    include_once('include/configuracion/tabla_provincias.php');
    
    $campos = array(
            array(
                'titulo' => 'CODIGO',
                'nombre' => 'codigo',
                'alineacion' => 'left',
                'ancho_celda' => '25'
            ),
            array(
                'titulo' => 'DESCRIPCION',
                'nombre' => 'descripcion',
                'alineacion' => 'left',
                'ancho_celda' => '70'
            )
        );
    
    print '<h1>Administraci&oacute;n de provincias</h1>';
    
    $tabla = new TablaProvincias();
    
    $tabla->set_encabezado(new Encabezado($campos));
    
    $boton_nuevo = new EnlaceFlat('agregar-provincias', 'Nueva provincia', '?include=configuracion&form=form_edicion_provincia&type=alta', 'agregar-item');
    
    $boton_nuevo->show();
    
    $tabla->iniciar_tabla('tabla-provincias');
    
    $tabla->show();
    
    $tabla->cerrar_tabla();
    
?>