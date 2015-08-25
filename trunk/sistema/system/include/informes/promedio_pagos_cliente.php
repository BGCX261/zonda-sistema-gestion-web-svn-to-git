<?php
    
    include ('../../conexion.php');
    
    $Date = explode('/', $_POST['fecha_inicio']);
    $FechaInicio = $Date[2].'/'.$Date[1].'/'.$Date[0];
    $Date = explode('/', $_POST['fecha_fin']);
    $FechaFin = $Date[2].'/'.$Date[1].'/'.$Date[0];
    
    $FechaInicio = date_create($FechaInicio);
    $FechaFin = date_create($FechaFin);
    
    $Intervalo = $FechaFin->diff($FechaInicio);
    
    if (strcmp($Intervalo->format('%R'), '-'))
        return;
    
    $query = "
        SELECT 
            SUM(movimientos.monto) / COUNT(movimientos.codigo) 
        FROM
            movimientos,
            ventas 
        WHERE
            movimientos.tipo = 6 
            AND 
            movimientos.operacion = ventas.codigo 
            AND 
            ventas.cliente = ".$_POST['parametro']." 
            AND 
            compras.fecha >= '".$FechaInicio->format('Y-m-d')." 00:00:00' 
            AND 
            compras.fecha <= '".$FechaFin->format('Y-m-d')." 23:59:59'";
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        print mysql_error();
        return;
    }
    
    if (mysql_numrows($Result) < 1) {
        print '0';
        return;
    }
    
    $Row = mysql_fetch_array($Result);
    
    if ($Row[0])
        print '$'.number_format($Row[0], 2).' por pago';
    else
        print 'No hay pagos registrados.'
    
?>