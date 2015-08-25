<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de compras por proveedores</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
        
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'proveedores.razon',
                'nombre' => 'Proveedor'
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
            proveedores.razon,
            SUM(compras_detalle.cantidad) 'cantidad',
            SUM(compras_detalle.cantidad * compras_detalle.precio) 'total' 
        FROM
            compras_detalle,
            articulos,
            proveedores
        WHERE
            compras_detalle.compra IN (
                SELECT
                    compras.codigo
                FROM
                    compras
                WHERE
                    compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            )  
            AND
            compras_detalle.articulo = articulos.codigo
            AND
            articulos.proveedor = proveedores.codigo 
        GROUP BY 
            proveedores.razon ";
    
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
    
    $NombreCampos = array('Proveedor', 'Cantidad de artículos', 'Monto de las compras');
    
    $Alineacion = array('left', 'right', 'right');
    
    $AnchoCelda = array('40%', '30%', '30%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>