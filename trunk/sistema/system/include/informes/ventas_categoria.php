<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de ventas por categorías</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'categorias.categoria',
                'nombre' => 'Categoría'
            ),
            array(
                'valor' => 'cantidad',
                'nombre' => 'Cantidad'
            ),
            array(
                'valor' => 'total',
                'nombre' => 'Total'
            )
        );
        
        include ('include/form_parametros.php');
    
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query = "
        SELECT
            categorias.categoria,
            SUM(ventas_detalle.cantidad) 'cantidad',
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'total' 
        FROM
            ventas_detalle,
            articulos,
            categorias
        WHERE
            ventas_detalle.venta IN (
                SELECT
                    ventas.codigo
                FROM
                    ventas
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            )  
            AND
            ventas_detalle.articulo = articulos.codigo
            AND
            articulos.categoria = categorias.codigo  
        GROUP BY
            categorias.categoria ";
    
    if(isset($_REQUEST['filtro']) && !empty($_REQUEST['filtro']) && isset($_REQUEST['valor']) && !empty($_REQUEST['valor'])) {
        $query .= " HAVING ".$_REQUEST['filtro']." ".$_REQUEST['comparacion']." '".$_REQUEST['valor']."";
        if ($_REQUEST['comparacion'] = 'LIKE') {
            $query .= "%";
        }
        $query .= "' ";
    }
    
    if(isset($_REQUEST['orden']) && isset($_REQUEST['direccion'])) {
        $query .= " ORDER BY ".$_REQUEST['orden']." ".$_REQUEST['direccion'];
    }
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Categoría', 'Cantidad de artículos', 'Monto de las ventas');
    
    $Alineacion = array('left', 'right', 'right');
    
    $AnchoCelda = array('60%', '20%', '20%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>