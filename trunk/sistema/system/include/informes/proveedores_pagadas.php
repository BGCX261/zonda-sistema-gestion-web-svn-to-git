<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de facturas pagadas a proveedores</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'compras.codigo',
                'nombre' => 'Código'
            ),
            array(
                'valor' => 'compras.factura',
                'nombre' => 'Factura'
            ),
            array(
                'valor' => 'compras.fecha',
                'nombre' => 'Fecha'
            ),
            array(
                'valor' => 'proveedores.razon',
                'nombre' => 'Proveedores'
            ),
            array(
                'valor' => 'compras.monto',
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
            LPAD(compras.codigo, 12, 0),
            LPAD(compras.factura, 12, 0),
            CONCAT_WS(' ', DATE_FORMAT(compras.fecha, '%d/%m/%Y'), DATE_FORMAT(compras.fecha, '%H:%i:%S')),
            proveedores.razon,
            compras.monto  
        FROM 
            compras,
            proveedores 
        WHERE 
            compras.proveedor = proveedores.codigo 
            AND 
            compras.saldo <= 0  
            AND 
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $CriterioOrden = 'compras.codigo';
    
    include_once('include/orden_informe.php');
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código de la operación', 'Número de factura', 'Fecha de facturación', 'Razón social', 'Monto');
    
    $Alineacion = array('left', 'left', 'left', 'left', 'right');
    
    $AnchoCelda = array('15%', '15%', '20%', '40%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>