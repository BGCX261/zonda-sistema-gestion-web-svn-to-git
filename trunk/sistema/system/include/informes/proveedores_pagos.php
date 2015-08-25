<?php
    
    include ('include/util.php');
    
    print '<h1>Listado de pagos realizados a proveedores</h1>';
    
    if (!isset($_REQUEST['impresion'])) { 
    
        include ('include/botones_informe.php');
        
        $Opciones = array(
            array(
                'valor' => 'pagos.codigo',
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
                'valor' => 'pagos.operacion',
                'nombre' => 'Operación'
            ),
            array(
                'valor' => 'fondos.descripcion',
                'nombre' => 'Fondo'
            ),
            array(
                'valor' => 'pagos.monto',
                'nombre' => 'Monto'
            )
        );
        
        include ('include/form_parametros.php');
    
    }
    
    $query = "
        SELECT
            LPAD(pagos.codigo, 12, 0),
            CONCAT_WS(' ', DATE_FORMAT(pagos.fecha, '%d/%m/%Y'), DATE_FORMAT(pagos.fecha, '%H:%i:%S')),
            proveedores.razon,
            usuarios.apodo,
            LPAD(pagos.operacion, 12, 0),
            fondos.descripcion,
            pagos.monto 
        FROM
            pagos,
            usuarios,
            proveedores,
            fondos
        WHERE
            pagos.proveedor = proveedores.codigo 
            AND 
            pagos.usuario = usuarios.codigo 
            AND 
            pagos.fondo = fondos.codigo 
            AND 
            pagos.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            pagos.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' ";
    
    $CriterioOrden = 'pagos.codigo';
    
    include_once('include/orden_informe.php');
    
    $Registros = mysql_num_rows(mysql_query($query));
    
    include_once('include/cantidad_registros.php');
    
    $NombreCampos = array('Código', 'Fecha', 'Proveedor', 'Usuario', 'Operación', 'Fondo', 'Monto');
    
    $Alineacion = array('left', 'left', 'left', 'left', 'left', 'left', 'right');
    
    $AnchoCelda = array('10%', '20%', '25%', '10%', '10%', '15%', '10%');
    
    listadoLineal($query, $NombreCampos, $Alineacion, $AnchoCelda);
    
?>