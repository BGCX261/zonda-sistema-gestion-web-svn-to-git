<?php

    include ('include/util.php');
    
    print '<h1>Listado de artículos que no se han vendido</h1>';
    
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
            )
        );
        
        include ('include/form_parametros.php');
        
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query = "
        SELECT
            LPAD(articulos.codigo, 12, 0),
            articulos.descripcion,
            categorias.categoria,
            proveedores.razon 
        FROM
            articulos,
            categorias,
            proveedores
        WHERE
            categorias.codigo = articulos.categoria 
            AND 
            proveedores.codigo = articulos.proveedor 
            AND  
            articulos.codigo NOT IN (
                SELECT
                    ventas_detalle.articulo
                FROM
                    ventas_detalle,
                    ventas
                WHERE
                    ventas_detalle.venta = ventas.codigo 
                    AND
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])."' 
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])."' 
            ) ";
    
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
    
    $NombreCampos = array('Código', 'Descripción', 'Categoría', 'Proveedor');
    
    $Alineacion = array('left', 'left', 'left', 'left');
    
    $AnchoCelda = array('20%', '30%', '20%', '20%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>