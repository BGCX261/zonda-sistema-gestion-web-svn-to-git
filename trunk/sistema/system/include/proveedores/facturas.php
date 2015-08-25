<?php

    include_once('include/listado.php');
    
    $Listado = new Listado();
    
    $Listado->Titulo = 'Listado de facturas pendientes de proveedores';
    
    $Listado->ConsultaRegistros = '
        SELECT
            *
        FROM
            compras,
            proveedores
        WHERE
            compras.saldo > 0
            AND
            compras.proveedor = proveedores.codigo';
    
    $Listado->Consulta = "
        SELECT
            LPAD(compras.codigo, 11, 0),
            DATE_FORMAT(compras.fecha, '%d-%m-%Y %H:%i:%s'),
            proveedores.razon,
            compras.monto,
            compras.saldo   
        FROM
            compras,
            proveedores
        WHERE
            compras.proveedor = proveedores.codigo AND
            compras.saldo > 0 ";
    
    $Listado->Campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'compras.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '15',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'FECHA',
            'nombre' => 'compras.fecha',
            'alias' => 'Fecha',
            'alineacion' => 'left',
            'ancho_celda' => '20'
        ),
        array(
            'titulo' => 'PROVEEDOR',
            'nombre' => 'proveedores.razon',
            'alias' => 'Proveedor',
            'alineacion' => 'left',
            'ancho_celda' => '30',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'MONTO',
            'nombre' => 'compras.monto',
            'alias' => 'Monto',
            'alineacion' => 'right',
            'ancho_celda' => '10',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'SALDO',
            'nombre' => 'compras.saldo',
            'alias' => 'Saldo',
            'alineacion' => 'right',
            'ancho_celda' => '10',
            'busqueda' => 1
        )
    );
    
    $Listado->NombreFiltro = 'filtro_facturas';
    
    $Listado->NombreTabla = 'tablaFacturas';
    
    $Listado->Funciones = array(
        array(
            'nombre' => 'Detalles',
            'referencia' => '?include=proveedores&form=mostrar_factura'
        ),
        array(
            'nombre' => 'Pagar',
            'referencia' => '?include=proveedores&form=form_factura'
        )
    );
    
    $Listado->Mostrar();
    
?>
