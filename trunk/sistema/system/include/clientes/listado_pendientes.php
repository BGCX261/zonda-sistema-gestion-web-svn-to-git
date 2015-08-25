<?php

    include_once('include/table_handler.php');
    include_once('include/tabla_generica.php');
    include_once('include/acciones_tabla.php');
    include_once('include/accion_borrar_activar.php');
    include_once('include/formatter.php');
    include_once('include/encabezado_tabla.php');
    include_once('include/configuracion/provincias.php');
    include_once('include/configuracion/localidades.php');
    include_once('include/clientes/pendientes.php');
    include_once('include/clientes/tabla_pendientes.php');
    
    $campos = array(
            array(
                'titulo' => 'RAZON SOCIAL',
                'nombre' => 'clientes_pendientes.razon',
                'alias' => 'razon',
                'alineacion' => 'left',
                'ancho_celda' => '13'
            ),
            array(
                'titulo' => 'NOMBRE',
                'nombre' => 'clientes_pendientes.nombre',
                'alias' => 'nombre',
                'alineacion' => 'left',
                'ancho_celda' => '13'
            ),
            array(
                'titulo' => 'DOMICILIO',
                'nombre' => 'clientes_pendientes.domicilio',
                'alias' => 'domicilio',
                'alineacion' => 'left',
                'ancho_celda' => '9'
            ),
            array(
                'titulo' => 'TELEFONO',
                'nombre' => 'clientes_pendientes.telefono',
                'alias' => 'telefono',
                'alineacion' => 'left',
                'ancho_celda' => '9'
            ),
            array(
                'titulo' => 'PROVINCIA',
                'nombre' => 'clientes_pendientes.provincia',
                'alias' => 'provincia',
                'alineacion' => 'left',
                'ancho_celda' => '9'
            ),
            array(
                'titulo' => 'LOCALIDAD',
                'nombre' => 'clientes_pendientes.localidad',
                'alias' => 'localidad',
                'alineacion' => 'left',
                'ancho_celda' => '9'
            ),
            array(
                'titulo' => 'CONTACTO',
                'nombre' => 'clientes_pendientes.contacto',
                'alias' => 'contacto',
                'alineacion' => 'left',
                'ancho_celda' => '13'
            ),
            array(
                'titulo' => 'PAGINA',
                'nombre' => 'clientes_pendientes.pagina',
                'alias' => 'pagina',
                'alineacion' => 'left',
                'ancho_celda' => '10'
            ),
            array(
                'titulo' => 'CORREO',
                'nombre' => 'clientes_pendientes.correo',
                'alias' => 'correo',
                'alineacion' => 'left',
                'ancho_celda' => '10'
            )
        );
    
    print '<h1>Listado de clientes pendientes de alta</h1>';
    
    $tabla = new TablaPendientes();
    
    $tabla->iniciar_tabla('tabla-pendientes');
    
    $encabezado = new EncabezadoTabla();
    
    $encabezado->show($campos);
    
    $tabla->show();
    
    $tabla->cerrar_tabla();
    
?>