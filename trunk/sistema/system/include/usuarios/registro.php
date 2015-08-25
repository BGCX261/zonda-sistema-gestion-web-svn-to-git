<?php

    include_once('include/listado.php');
    
    $Listado = new Listado();
    
    $Listado->Titulo = 'Registro de ingreso de los usuarios';
    
    $Listado->ConsultaRegistros = 'SELECT * FROM usuarios_registro, usuarios WHERE usuarios_registro.usuario = usuarios.codigo';
    
    $Listado->Consulta = "
        SELECT
            usuarios_registro.codigo,
            DATE_FORMAT(usuarios_registro.fecha, '%d-%m-%Y %H:%i:%s'),
            usuarios.apodo,
            usuarios_registro.ip 
        FROM
            usuarios_registro,
            usuarios
        WHERE
            usuarios_registro.usuario = usuarios.codigo";
    
    $Listado->Campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'usuarios_registro.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'FECHA',
            'nombre' => 'usuarios_registro.fecha',
            'alias' => 'Fecha',
            'alineacion' => 'left',
            'ancho_celda' => '40'
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
            'titulo' => 'IP',
            'nombre' => 'usuarios_registro.ip',
            'alias' => 'IP',
            'alineacion' => 'right',
            'ancho_celda' => '20',
            'busqueda' => 1
        )
    );
    
    $Listado->NombreFiltro = 'filtro_registro';
    
    $Listado->NombreTabla = 'tablaRegistro';
    
    $Listado->Mostrar();

?>