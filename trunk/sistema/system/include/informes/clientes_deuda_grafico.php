<div>

    <h1>Desarrollo del saldo del cliente</h1>
    
    <?php
    
        include ('include/util.php');
            
        $Opciones = array();

        $query = "SELECT codigo, razon FROM clientes ORDER BY razon";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        while ($Row = mysql_fetch_array($Result)) {

            array_push($Opciones, array('valor' => $Row[0], 'nombre' => $Row[1]));

        }

        include ('include/form_valor.php');

    ?>
    
</div>

<div id="grafico" class="grafico">

    <!--    -->

</div>

<?php
    
    $FechaInicio = date_create(rotateDate($_REQUEST['fecha-inicio']));
    $FechaFin = date_create(rotateDate($_REQUEST['fecha-fin']));
    
    $Intervalo = $FechaFin->diff($FechaInicio);
    
    if (strcmp($Intervalo->format('%R'), '-'))
        return;
    
    $Fecha = $FechaFin;
    
    $query = "
        SELECT
            clientes.saldo
        FROM
            clientes 
        WHERE
            clientes.codigo = ".$_REQUEST['valor'];
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        print sql_error_msg();
        return;
    }
    
    $Saldo = mysql_fetch_array($Result);
    
    $query = "
        SELECT
            DATE_FORMAT(ventas.fecha, '%Y-%m-%d') orden,
            SUM(ventas.monto) 
        FROM 
            ventas  
        WHERE 
            ventas.fecha >= '".$FechaInicio->format('Y-m-d')." 00:00:00'
            AND
            ventas.fecha <= '".$FechaFin->format('Y-m-d')." 23:59:59' 
            AND 
            ventas.cliente = ".$_REQUEST['valor']."
        GROUP BY
            orden";
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        print mysql_error();
        return;
    }
    
    $Ventas = array();
    $i = 0;
    
    while ($Row = mysql_fetch_array($Result)) {
        $Ventas[$i]['fecha'] = rotateDate($Row[0]);
        $Ventas[$i]['monto'] = $Row[1];
        $i++;
    }
    
    $query = "
        SELECT
            DATE_FORMAT(cobros.fecha, '%Y-%m-%d') orden, 
            SUM(cobros.monto) 
        FROM
            cobros
        WHERE 
            cobros.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            cobros.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            AND 
            cobros.cliente = ".$_REQUEST['valor']."
        GROUP BY
            orden";
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    $Pagos = array();
    $i = 0;
    
    while ($Row = mysql_fetch_array($Result)) {
        $Pagos[$i]['fecha'] = rotateDate($Row[0]);
        $Pagos[$i]['monto'] = $Row[1];
        $i++;
    }
    
    $IndiceVenta = sizeof($Ventas) - 1;
    $IndicePago = sizeof($Pagos) - 1;
    $i = $Intervalo->format('%a') - 1;
    
    $Data = array();
    $Data[$i] = $Saldo[0];
    
    do {
        
        $i--;
        $Fecha->sub(new DateInterval('P1D'));
        $Data[$i] = $Data[$i + 1];
        if ($IndiceVenta >= 0 && !strcmp($Ventas[$IndiceVenta]['fecha'], $Fecha->format('d-m-Y'))) {
            $Data[$i] -= $Ventas[$IndiceVenta]['monto'];
            $IndiceVenta--;
        }
        if ($IndicePago >= 0 && !strcmp($Pagos[$IndicePago]['fecha'], $Fecha->format('d-m-Y'))) {
            $Data[$i] += $Pagos[$IndicePago]['monto'];
            $IndicePago--;
        }
        
    } while ($i > 0);
    
    $Data = array_reverse($Data);
    $ChartData = "";
    
    foreach($Data as $Value) {
        $ChartData .= $Value.",";
    }
    $ChartData = substr($ChartData, 0, strlen($ChartData) - 1);
    
?>

<script>
    
    $(function () {
        
        var chart1;
        
        $(document).ready(function() {
            chart1 = new Highcharts.Chart({
                chart: {
                    renderTo: 'grafico',
                    spacingRight: 20
                },
                title: {
                    text: 'Desarrollo de la deuda de cliente por dia'
                },
                xAxis: {
                    type: 'datetime',
                    title: {
                        text: 'Fecha'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Monto'
                    },
                    min: 0.0,
                    startOnTick: false,
                    showFirstLabel: false
                },
                tooltip: {
                    shared: true
                },
                legend: {
                    enabled: false
                },
                plotOptions: {
                    area: {
                        fillColor: {
                            linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1},
                            stops: [
                                [0, Highcharts.getOptions().colors[2]],
                                [1, 'rgba(0,2,0,0)']
                            ]
                        },
                        lineWidth: 1,
                        marker: {
                            enabled: false,
                            states: {
                                hover: {
                                    enabled: true,
                                    radius: 5
                                }
                            }
                        },
                        shadow: false,
                        states: {
                            hover: {
                                lineWidth: 1
                            }
                        },
                        pointInterval: 24 * 3600 * 1000,
                        pointStart: Date.UTC(<?php print $FechaInicio->format('Y, m - 1, d'); ?>)
                    }
                },
                series: [ {
                        type: 'area',
                        name: 'Monto de la deuda',
                        data: [ <?php print $ChartData; ?> ]
                    }
                ]
            });
            
        });
        
    });

</script>