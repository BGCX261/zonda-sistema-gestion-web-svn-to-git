<?php
    include_once('../listado.php');
    $Listado = new Listado();
    $Listado->Titulo = 'Listado de proveedores';
    $Listado->ConsultaRegistros = "
        SELECT
            proveedores.codigo 
        FROM
            proveedores,
            localidades 
        WHERE
            localidades.codigo = proveedores.localidad ";
    $Listado->Consulta = "
        SELECT
            LPAD(proveedores.codigo, 11, 0),
            proveedores.razon,
            proveedores.domicilio,
            proveedores.telefono,
            localidades.localidad,
            proveedores.pagina,
            proveedores.correo,
            proveedores.saldo
        FROM
            proveedores,
            localidades 
        WHERE
            localidades.codigo = proveedores.localidad ";
    $Listado->Campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'proveedores.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '10',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'RAZON SOCIAL',
            'nombre' => 'proveedores.razon',
            'alias' => 'Razón social',
            'alineacion' => 'left',
            'ancho_celda' => '30',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'DOMICILIO',
            'nombre' => 'proveedores.domicilio',
            'alias' => 'Domicilio',
            'alineacion' => 'left',
            'ancho_celda' => '10',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'TELEFONO',
            'nombre' => 'proveedores.telefono',
            'alias' => 'Teléfono',
            'alineacion' => 'left',
            'ancho_celda' => '20',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'LOCALIDAD',
            'nombre' => 'localidades.localidad',
            'alias' => 'Localidad',
            'alineacion' => 'left',
            'ancho_celda' => '10',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'PAGINA WEB',
            'nombre' => 'proveedores.pagina',
            'alias' => 'Página Web',
            'alineacion' => 'left',
            'ancho_celda' => '10',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'CORREO',
            'nombre' => 'proveedores.correo',
            'alias' => 'Correo electrónico',
            'alineacion' => 'left',
            'ancho_celda' => '10',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'SALDO',
            'nombre' => 'proveedores.saldo',
            'alias' => 'Saldo',
            'alineacion' => 'right',
            'ancho_celda' => '10',
            'busqueda' => 1
        )
    );
    $Listado->NombreFiltro = 'filtro_proveedores';
    $Listado->NombreTabla = 'tablaProveedores';
    $Listado->Funciones = '
        <a class="accion-tabla editar-registro">Editar</a>
        <br />
        <a class="accion-tabla borrar-registro">Borrar</a>
        <br />';
    $Listado->Mostrar(); 
?>