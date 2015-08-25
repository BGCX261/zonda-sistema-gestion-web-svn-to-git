<?php

    include_once('include/enlace.php');
    include_once('include/enlace_flat.php');
    include_once('include/encabezado.php');
    include_once('include/tabla_generica.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/articulos/categorias.php');
    include_once('include/articulos/tabla_categorias.php');
    
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
    
    print '<h1>Administraci&oacute;n de categor&iacute;as</h1>';
    
    $tabla = new TablaCategorias();
    
    $tabla->set_encabezado(new Encabezado($campos));
    
    $boton_nuevo = new EnlaceFlat('agregar-categoria', 'Nueva categoría', '?include=articulos&form=form_edicion_categoria&type=alta', 'agregar-item');
    
    $boton_nuevo->show();
    
    $tabla->iniciar_tabla("tabla-categorias");
    
    $tabla->show();
    
    $tabla->cerrar_tabla();
    
?>