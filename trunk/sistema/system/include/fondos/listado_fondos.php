<?php

    include_once('include/table_handler.php');
    include_once('include/tabla.php');
    include_once('include/tabla_generica.php');
    include_once('include/acciones_tabla.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/formatter.php');
    include_once('include/fondos/fondos.php');
    include_once('include/fondos/tabla_fondos.php');
    
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
                'ancho_celda' => '60'
            ),
            array(
                'titulo' => 'SALDO',
                'nombre' => 'saldo',
                'alineacion' => 'right',
                'ancho_celda' => '20'
            )
        );
    
    print '<h1>Administraci&oacute;n de fondos</h1>';
    
    print '<table name="tabla-fondos" class="ui-widget tabla-datos">';
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $tabla = new TablaFondos();
    
    $tabla->show();
    
    print '</table>';
    
?>