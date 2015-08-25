<?php

    include ('include/util.php');
    
    print '<h1>Listado de pagos realizados por cliente</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'cobros.codigo',
                'nombre' => 'Código'
            ),
            array(
                'valor' => 'clientes.razon',
                'nombre' => 'Cliente'
            ),
            array(
                'valor' => 'usuarios.apodo',
                'nombre' => 'Usuario'
            ),
            array(
                'valor' => 'cobros.operacion',
                'nombre' => 'Operación'
            ),
            array(
                'valor' => 'fondos.descripcion',
                'nombre' => 'Fondo'
            ),
            array(
                'valor' => 'cobros.monto',
                'nombre' => 'Monto'
            )
        );
        
        include ('include/form_parametros.php');
    
    }
    
    $query = "
        SELECT
            LPAD(cobros.codigo, 12, 0),
            CONCAT_WS(' ', DATE_FORMAT(cobros.fecha, '%d/%m/%Y'), DATE_FORMAT(cobros.fecha, '%H:%i:%S')),
            clientes.razon,
            usuarios.apodo,
            LPAD(cobros.operacion, 12, 0),
            fondos.descripcion,
            cobros.monto 
        FROM
            cobros,
            usuarios,
            clientes,
            fondos
        WHERE
            cobros.cliente = clientes.codigo 
            AND 
            cobros.usuario = usuarios.codigo 
            AND 
            cobros.fondo = fondos.codigo 
            AND 
            cobros.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            cobros.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $CriterioOrden = 'cobros.codigo';
    
    include_once('include/orden_informe.php');
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código', 'Fecha', 'Cliente', 'Usuario', 'Operación', 'Fondo', 'Monto');
    
    $Alineacion = array('left', 'left', 'left', 'left', 'left', 'left', 'right');
    
    $AnchoCelda = array('10%', '20%', '25%', '10%', '10%', '15%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>