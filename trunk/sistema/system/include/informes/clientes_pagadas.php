<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de facturas cobradas a clientes</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
        
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'ventas.codigo',
                'nombre' => 'Código'
            ),
            array(
                'valor' => 'ventas.factura',
                'nombre' => 'Factura'
            ),
            array(
                'valor' => 'ventas.fecha',
                'nombre' => 'Fecha'
            ),
            array(
                'valor' => 'clientes.razon',
                'nombre' => 'Cliente'
            ),
            array(
                'valor' => 'ventas.monto',
                'nombre' => 'Monto'
            )
        );
    
        include ('include/form_parametros.php');
        
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $query = "
        SELECT
            LPAD(ventas.codigo, 12, 0),
            LPAD(ventas.factura, 12, 0),
            CONCAT_WS(' ', DATE_FORMAT(ventas.fecha, '%d/%m/%Y'), DATE_FORMAT(ventas.fecha, '%H:%i:%S')),
            clientes.razon,
            ventas.monto  
        FROM 
            ventas,
            clientes 
        WHERE 
            ventas.cliente = clientes.codigo 
            AND 
            ventas.saldo <= 0  
            AND 
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $CriterioOrden = 'ventas.codigo';
    
    include_once('include/orden_informe.php');
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código de la operación', 'Número de factura', 'Fecha de facturación', 'Razón social', 'Monto');
    
    $Alineacion = array('left', 'left', 'left', 'left', 'right');
    
    $AnchoCelda = array('15%', '15%', '20%', '40%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>