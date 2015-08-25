<?php

    include_once('include/listado.php');
    
    $Listado = new Listado();
    $Listado->Titulo = 'Listado de talonarios';
    $Listado->ConsultaRegistros = 'SELECT * FROM talonarios';
    $Listado->Consulta = "
        SELECT
            LPAD(talonarios.codigo, 11, 0),
            talonarios.descripcion,
            DATE_FORMAT(talonarios.fecha, '%d-%m-%Y %H:%i:%s'), 
            talonarios.inicio,
            talonarios.actual 
        FROM
            talonarios";
    $Listado->Campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'talonarios.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'DESCRIPCION',
            'nombre' => 'talonarios.descripcion',
            'alias' => 'Descripción',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'FECHA',
            'nombre' => 'talonarios.fecha',
            'alias' => 'Fecha',
            'alineacion' => 'left',
            'ancho_celda' => '20'
        ),
        array(
            'titulo' => 'INICIO',
            'nombre' => 'talonarios.inicio',
            'alias' => 'Inicio',
            'alineacion' => 'right',
            'ancho_celda' => '20'
        ),
        array(
            'titulo' => 'ACTUAL',
            'nombre' => 'talonarios.actual',
            'alias' => 'Actual',
            'alineacion' => 'right',
            'ancho_celda' => '20'
        )
    );
    $Listado->NombreFiltro = 'filtro_talonarios';
    $Listado->NombreTabla = 'tablaTalonarios';
    $Listado->Funciones = array(
        array(
            'nombre' => 'Editar',
            'referencia' => '?include=ventas&form=form_edicion_talonario'
        ),
        array(
            'nombre' => 'Borrar',
            'referencia' => '?include=ventas&action=baja_talonario',
            'accion' => 'return confirm(\'Desea eliminar este talonario de forma permanente?\')'
        )
    );
    $Listado->BotonNuevoRegistro = '<a href="?include=ventas&form=form_alta_talonario" id="agregar-talonario" class="enlace-agregar">Agregar un nuevo talonario</a><br><br>';
    $Listado->Mostrar();
    
?>