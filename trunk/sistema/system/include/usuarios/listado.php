<?php

    include_once('include/listado.php');
    
    $Listado = new Listado();
    
    $Listado->Titulo = 'Listado de usuarios';
    
    $Listado->ConsultaRegistros = 'SELECT * FROM usuarios';
    
    $Listado->Consulta = 'SELECT LPAD(codigo, 11, 0), nombre, apodo, correo FROM usuarios';
    
    $Listado->Campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'usuarios.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'NOMBRE',
            'nombre' => 'usuarios.nombre',
            'alias' => 'Nombre',
            'alineacion' => 'left',
            'ancho_celda' => '40',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'APODO',
            'nombre' => 'usuarios.apodo',
            'alias' => 'Apodo',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'CORREO',
            'nombre' => 'usuarios.correo',
            'alias' => 'Correo electrónico',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        )
    );
    
    $Listado->NombreFiltro = 'filtro_usuarios';
    $Listado->NombreTabla = 'tablaUsuarios';
    
    if ($_COOKIE['usuario'] == 1) {
        $Listado->Funciones = array(
            array(
                'nombre' => 'Editar',
                'referencia' => '?include=usuarios&form=form_edicion'
            ),
            array(
                'nombre' => 'Borrar',
                'referencia' => '?include=usuarios&action=baja',
                'accion' => 'return confirm(\'Desea borrar este usuario de forma permanente?\')'
            )
        );
    }
    
    $Listado->Mostrar();

?>