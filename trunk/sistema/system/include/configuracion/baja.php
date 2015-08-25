<?php
    $form = $_REQUEST['form'];
    
    if (strpos($form, 'provincia')) {
        include_once('include/configuracion/baja_provincia.php');
    }
    elseif (strpos($form, 'localidad')) {
        include_once('include/configuracion/baja_localidad.php');
    }
    elseif (strpos($form, 'condicion')) {
        include_once('include/configuracion/baja_condicion.php');
    }
    elseif (strpos($form, 'alicuota')) {
        include_once('include/configuracion/baja_alicuota.php');
    }
    elseif (strpos($form, 'factura')) {
        include_once('include/configuracion/baja_tipo_factura.php');
    }
    else {
        /* === */
    }
?>