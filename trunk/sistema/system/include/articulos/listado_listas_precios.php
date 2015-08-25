<?php

    include_once('include/enlace.php');
    include_once('include/enlace_flat.php');
    include_once('include/encabezado.php');
    include_once('include/tabla_generica.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/articulos/listas_precios.php');
    include_once('include/articulos/tabla_listas_precios.php');
    
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
                'ancho_celda' => '45'
            ),
            array(
                'titulo' => 'ULTIMA ACTUALIZACION',
                'nombre' => 'actualizacion',
                'alineacion' => 'center',
                'ancho_celda' => '25'
            )
        );
    
    print '<h1>Administraci&oacute;n de listas de precios</h1>';
    
    $tabla = new TablaListasPrecios();
    
    $tabla->set_encabezado(new Encabezado($campos));
    
    $boton_nuevo = new EnlaceFlat('agregar-lista', 'Nueva lista de precios', '?include=articulos&form=form_edicion_lista_precios&type=alta', 'agregar-item');
    
    $boton_nuevo->show();
    
    $tabla->iniciar_tabla('tabla-listas-precios');
    
    $tabla->show();
    
    $tabla->cerrar_tabla();
    
?>