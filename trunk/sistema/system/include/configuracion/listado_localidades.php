<?php

    include_once('include/enlace.php');
    include_once('include/enlace_flat.php');
    include_once('include/encabezado.php');
    include_once('include/tabla_generica.php');
    include_once('include/formatter.php');
    include_once('include/acciones_tabla.php');
    include_once('include/formulario.php');
    include_once('include/campo.php');
    include_once('include/campo_combo.php');
    include_once('include/campo_oculto.php');
    include_once('include/boton.php');
    include_once('include/boton_flat.php');
    include_once('include/configuracion/provincias.php');
    include_once('include/configuracion/localidades.php');
    include_once('include/configuracion/tabla_localidades.php');
    
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
    
    print '<h1>Administraci&oacute;n de localidades</h1>';
    
    $formulario = new Formulario();
    $formulario->set_param('include', 'configuracion');
    $formulario->set_param('form', 'listado_localidades');
    $formulario->set_method('GET');
    $formulario->open();
    
    $combo = new CampoCombo('provincia', '');
    $provincias = new Provincias();
    $combo->set_sql_options($provincias->get_provincias());
    $combo->set_selected_option($_REQUEST['provincia']);
    $combo->show();
    
    print '<br>';
    
    $boton = new BotonFlat('ver', 'Ver localidades', 'aceptar-item');
    $boton->show();
    
    $formulario->close();
    
    print '<br>';
    
    $boton_nuevo = new EnlaceFlat('agregar-localidad', 'Nueva localidad', '?include=configuracion&form=form_edicion_localidad&type=alta', 'agregar-item');
    $boton_nuevo->show();
    
    $tabla = new TablaLocalidades($_REQUEST['provincia']);
    $tabla->set_encabezado(new Encabezado($campos));
    $tabla->iniciar_tabla('tabla-localidades');
    $tabla->show();
    $tabla->cerrar_tabla();
    
?>