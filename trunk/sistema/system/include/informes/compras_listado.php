<?php

    include ('include/util.php');
    
    print '<h1>Listado de compras</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        include ('include/form_fechas.php');
    
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query = "
        SELECT
            LPAD(compras.codigo, 12, 0),
            compras.factura, 
            CONCAT_WS(' ', DATE_FORMAT(compras.fecha, '%d/%m/%Y'),
            DATE_FORMAT(compras.fecha, '%H:%i:%S')),
            proveedores.razon,
            compras.monto 
        FROM
            compras,
            proveedores 
        WHERE
            compras.proveedor = proveedores.codigo 
            AND 
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $Registros = mysql_num_rows(mysql_query($query));
   
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código', 'Número de factura', 'Fecha', 'Proveedor', 'Monto');
    
    $Alineacion = array('left', 'left', 'center', 'left', 'right');
    
    $AnchoCelda = array('20%', '20%', '20%', '30%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>