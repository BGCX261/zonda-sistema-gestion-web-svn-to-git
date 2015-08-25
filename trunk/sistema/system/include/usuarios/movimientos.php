<?php

    include_once('include/listado.php');
    
    $Listado = new Listado();
    
    $Listado->Titulo = 'Movimientos realizados por los usuarios';
    
    $Listado->ConsultaRegistros = "
        SELECT
            *
        FROM
            movimientos,
            movimientos_tipo,
            usuarios
        WHERE
            movimientos.usuario = usuarios.codigo
            AND
            movimientos.tipo = movimientos_tipo.codigo";
    
    $Listado->Consulta = "
        SELECT
            movimientos.codigo,
            DATE_FORMAT(movimientos.fecha, '%d-%m-%Y %H:%i:%s'),
            usuarios.apodo,
            movimientos_tipo.descripcion,
            movimientos.operacion,
            movimientos.monto
        FROM
            movimientos,
            movimientos_tipo,
            usuarios
        WHERE
            movimientos.usuario = usuarios.codigo
            AND
            movimientos.tipo = movimientos_tipo.codigo ";
    
    $Listado->Campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'movimientos.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '10',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'FECHA',
            'nombre' => 'movimientos.fecha',
            'alias' => 'Fecha',
            'alineacion' => 'left',
            'ancho_celda' => '20'
        ),
        array(
            'titulo' => 'USUARIO',
            'nombre' => 'usuarios.apodo',
            'alias' => 'Usuario',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'MOVIMIENTO',
            'nombre' => 'movimientos_tipo.descripcion',
            'alias' => 'Movimiento',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'CODIGO DE OPERACION',
            'nombre' => 'movimientos.operacion',
            'alias' => 'Código de operación',
            'alineacion' => 'right',
            'ancho_celda' => '10',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'MONTO',
            'nombre' => 'movimientos.monto',
            'alias' => 'Monto de la operación',
            'alineacion' => 'right',
            'ancho_celda' => '10',
            'busqueda' => 1
        )
    );
    
    $Listado->NombreFiltro = 'filtro_movimientos';
    $Listado->NombreTabla = 'tablaMovimientos';
    
    $Listado->Mostrar();

?>