<?php

    include ('include/util.php');
    
    print '<h1>Listado de ventas</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        include ('include/form_fechas.php');
    
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query = "
        SELECT
            LPAD(ventas.codigo, 12, 0),
            ventas.factura, 
            CONCAT_WS(' ', DATE_FORMAT(ventas.fecha, '%d/%m/%Y'),
            DATE_FORMAT(ventas.fecha, '%H:%i:%S')),
            clientes.razon,
            ventas.monto 
        FROM
            ventas,
            clientes 
        WHERE
            clientes.codigo = ventas.cliente 
            AND 
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $Registros = mysql_num_rows(mysql_query($query));
   
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código', 'Factura', 'Fecha', 'Cliente', 'Total');
    
    $Alineacion = array('left', 'left', 'center', 'left', 'right');
    
    $AnchoCelda = array('15%', '15%', '20%', '40%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>