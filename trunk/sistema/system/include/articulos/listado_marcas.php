<?php

    include_once('include/enlace.php');
    include_once('include/enlace_flat.php');
    include_once('include/encabezado.php');
    include_once('include/tabla_generica.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/articulos/marcas.php');
    include_once('include/articulos/tabla_marcas.php');
    
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
    
    print '<h1>Administraci&oacute;n de marcas</h1>';
    
    $tabla = new TablaMarcas();
    $tabla->set_encabezado(new Encabezado($campos));
    
    $boton_nuevo = new EnlaceFlat('agregar-marca', 'Nueva marca', '?include=articulos&form=form_edicion_marca&type=alta', 'agregar-item');
    $boton_nuevo->show();
    
    $tabla->iniciar_tabla('tabla-marcas');
    $tabla->show();
    $tabla->cerrar_tabla();
    
?>