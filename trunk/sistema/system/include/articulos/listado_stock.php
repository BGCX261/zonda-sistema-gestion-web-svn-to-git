<?php
    include_once('../listado.php');
    $Listado = new Listado();
    $Listado->Titulo = 'Ajustes de stock';
    $Listado->ConsultaRegistros = "
        SELECT
            articulos.codigo 
        FROM
            articulos,
            categorias,
            proveedores
        WHERE
            categorias.codigo = articulos.categoria
            AND 
            proveedores.codigo = articulos.proveedor";
    $Listado->Consulta = "
        SELECT 
            LPAD(articulos.codigo, 11, 0),
            articulos.descripcion,
            categorias.categoria,
            proveedores.razon,
            articulos.existencia
        FROM 
            articulos,
            categorias,
            proveedores
        WHERE 
            categorias.codigo = articulos.categoria
            AND 
            proveedores.codigo = articulos.proveedor ";
    $Listado->Campos = array(
        array(
            'titulo' => 'CODIGO',
            'nombre' => 'articulos.codigo',
            'alias' => 'Código',
            'alineacion' => 'left',
            'ancho_celda' => '18',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'DESCRIPCION',
            'nombre' => 'articulos.descripcion',
            'alias' => 'Descripción',
            'alineacion' => 'left',
            'ancho_celda' => '36',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'CATEGORIA',
            'nombre' => 'categorias.categoria',
            'alias' => 'Categoría',
            'alineacion' => 'left',
            'ancho_celda' => '18',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'PROVEEDOR',
            'nombre' => 'proveedores.razon',
            'alias' => 'Proveedor',
            'alineacion' => 'left',
            'ancho_celda' => '18',
            'busqueda' => 1
        ),
        array(
            'titulo' => 'EXISTENCIA',
            'nombre' => 'articulos.existencia',
            'alias' => 'Existencia',
            'alineacion' => 'right',
            'ancho_celda' => '10',
            'busqueda' => 1
        )
    );
    $Listado->NombreFiltro = 'filtro_articulos';
    $Listado->NombreTabla = 'tablaArticulos';
    $Listado->Funciones = '
        <a class="accion-tabla ajustar-registro">Ajustar</a>
        <br />';
    $Listado->Mostrar();
?>