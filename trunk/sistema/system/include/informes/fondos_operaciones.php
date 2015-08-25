<?php

    include ('include/util.php');
    
    print '<h1>Listado de operaciones realizadas sobre los fondos</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'descripcion',
                'nombre' => 'Fondo'
            ),
            array(
                'valor' => 'fecha',
                'nombre' => 'Fecha'
            ),
            array(
                'valor' => 'monto',
                'nombre' => 'Monto'
            )
        );
    
        include ('include/form_parametros.php');
    
    }
    else {
        
        print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';
        
    }
    
    $CriterioOrden = 'descripcion';
    
    $query = "
        SELECT
            fondos.descripcion,
            fondos_creditos.fecha,
            fondos_creditos.monto,
            'Crédito' 
        FROM 
            fondos,
            fondos_creditos 
        WHERE 
            fondos.codigo = fondos_creditos.fondo 
            AND 
            fondos_creditos.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            fondos_creditos.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $query .= criterioFiltro();
                
    $query .= " UNION
        
        SELECT
            fondos.descripcion,
            fondos_debitos.fecha,
            fondos_debitos.monto,
            'Débito'  
        FROM 
            fondos,
            fondos_debitos 
        WHERE 
            fondos.codigo = fondos_debitos.fondo 
            AND 
            fondos_debitos.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            fondos_debitos.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $query .= criterioFiltro();
                
    $query .= " UNION
        
        SELECT
            fondos.descripcion,
            cobros.fecha,
            cobros.monto,
            'Cobro a cliente'  
        FROM 
            fondos,
            cobros 
        WHERE 
            fondos.codigo = cobros.fondo 
            AND 
            cobros.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            cobros.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $query .= criterioFiltro();
                
    $query .= " UNION
        
        SELECT
            fondos.descripcion,
            pagos.fecha,
            pagos.monto,
            'Pago a proveedor'  
        FROM 
            fondos,
            pagos 
        WHERE 
            fondos.codigo = pagos.fondo 
            AND 
            pagos.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            pagos.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'  ";
    
    $query .= criterioFiltro();
                
    $query .= " UNION
        
        SELECT
            fondos.descripcion,
            compras.fecha,
            compras.monto,
            'Compra a proveedor'  
        FROM 
            fondos,
            compras 
        WHERE 
            fondos.codigo = compras.fondo 
            AND 
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'  ";
    
    $query .= criterioFiltro();
                
    $query .= " UNION
        
        SELECT
            fondos.descripcion,
            ventas.fecha,
            ventas.monto,
            'Venta a cliente'  
        FROM 
            fondos,
            ventas 
        WHERE 
            fondos.codigo = ventas.fondo 
            AND 
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        ";
    
    include_once('include/orden_informe.php');
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Fondo', 'Fecha', 'Monto', 'Detalle');
    
    $Alineacion = array('left', 'center', 'right', 'center',);
    
    $AnchoCelda = array('35%', '20%', '15%', '30%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
    

    function criterioFiltro() {
        $query = "";
        if(isset($_REQUEST['filtro']) && !empty($_REQUEST['filtro']) && isset($_REQUEST['valor']) && !empty($_REQUEST['valor'])) {
            $query .= " AND ".$_REQUEST['filtro']." ".$_REQUEST['comparacion']." '".$_REQUEST['valor']."";
            if ($_REQUEST['comparacion'] == 'LIKE') {
                $query .= "%";
            }
            $query .= "' ";
        }
        return $query;
    }
    
?>