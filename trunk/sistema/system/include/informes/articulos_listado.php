<?php

    include ('include/util.php');
    
    print '<h1>Listado general de artículos</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
        
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'articulos.codigo',
                'nombre' => 'Código'
            ),
            array(
                'valor' => 'articulos.descripcion',
                'nombre' => 'Descripción'
            ),
            array(
                'valor' => 'categorias.categoria',
                'nombre' => 'Categoría'
            ),
            array(
                'valor' => 'proveedores.razon',
                'nombre' => 'Proveedor'
            ),
            array(
                'valor' => 'articulos.costo',
                'nombre' => 'Costo'
            ),
            array(
                'valor' => 'articulos.existencia',
                'nombre' => 'Existencia'
            )
        );
        
        include ('include/form_informe.php');
    
    }
    
    $query = "
        SELECT
            LPAD(articulos.codigo, 12, 0),
            articulos.descripcion,
            categorias.categoria,
            proveedores.razon,
            articulos.costo,
            articulos.existencia 
        FROM
            articulos,
            categorias,
            proveedores
        WHERE
            categorias.codigo = articulos.categoria
            AND 
            proveedores.codigo = articulos.proveedor ";
    
    if(isset($_REQUEST['filtro']) && !empty($_REQUEST['filtro']) && isset($_REQUEST['valor']) && !empty($_REQUEST['valor'])) {
        $query .= " AND ".$_REQUEST['filtro']." ".$_REQUEST['comparacion']." '".$_REQUEST['valor']."";
        if ($_REQUEST['comparacion'] = 'LIKE') {
            $query .= "%";
        }
        $query .= "' ";
    }
    
    $query .= " ORDER BY ".$_REQUEST['orden'];
    
    if(isset($_REQUEST['direccion'])) {
        $query .= " ".$_REQUEST['direccion'];
    }
    
    if(isset($_REQUEST['orden']) && $_REQUEST['orden'] != 'articulos.codigo') {
        $query .= ", articulos.codigo";
    }
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código', 'Descripción', 'Categoría', 'Proveedor', 'Costo', 'Existencia');
    
    $Alineacion = array('left', 'left', 'left', 'left', 'right', 'right');
    
    $AnchoCelda = array('10%', '30%', '20%', '20%', '10%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>