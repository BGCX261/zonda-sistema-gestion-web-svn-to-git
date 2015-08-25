<div>

    <h1>Desarrollo del saldo de fondo</h1>
    
    <?php
    
        include ('include/util.php');
            
        $Opciones = array();

        $query = "SELECT codigo, descripcion FROM fondos ORDER BY descripcion";

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
            fondos.saldo
        FROM
            fondos 
        WHERE
            fondos.codigo = ".$_REQUEST['valor'];
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    if (mysql_num_rows($Result) > 0) {
    
        $Saldo = mysql_fetch_array($Result);

        $query = "
            SELECT
                DATE_FORMAT(ventas.fecha, '%Y-%m-%d') 'orden',
                SUM(ventas.monto) 
            FROM 
                ventas 
            WHERE 
                ventas.fecha >= '".$FechaInicio->format('Y-m-d')." 00:00:00'
                AND
                ventas.fecha <= '".$FechaFin->format('Y-m-d')." 23:59:59' 
                AND 
                ventas.fondo = ".$_REQUEST['valor']." 
            GROUP BY
                orden";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        $Ventas = array();
        $i = 0;

        while ($Row = mysql_fetch_array($Result)) {
            $Ventas[$i]['fecha'] = $Row[0];
            $Ventas[$i]['monto'] = $Row[1];
            $i++;
        }

        $query = "
            SELECT
                DATE_FORMAT(compras.fecha, '%Y-%m-%d') 'orden',
                SUM(compras.monto) 
            FROM 
                compras 
            WHERE 
                compras.fecha >= '".$FechaInicio->format('Y-m-d')." 00:00:00'
                AND
                compras.fecha <= '".$FechaFin->format('Y-m-d')." 23:59:59' 
                AND 
                compras.fondo = ".$_REQUEST['valor']." 
            GROUP BY
                orden";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        $Compras = array();
        $i = 0;

        while ($Row = mysql_fetch_array($Result)) {
            $Compras[$i]['fecha'] = $Row[0];
            $Compras[$i]['monto'] = $Row[1];
            $i++;
        }

        $query = "
            SELECT 
                DATE_FORMAT(fondos_creditos.fecha, '%Y-%m-%d') 'orden',
                SUM(fondos_creditos.monto)
            FROM 
                fondos_creditos 
            WHERE 
                fondos_creditos.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                AND 
                fondos_creditos.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
                AND 
                fondos_creditos.fondo = ".$_REQUEST['valor']." 
            GROUP BY
                orden";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        $Creditos = array();
        $i = 0;

        while ($Row = mysql_fetch_array($Result)) {
            $Creditos[$i]['fecha'] = rotateDate($Row[0]);
            $Creditos[$i]['monto'] = $Row[1];
            $i++;
        }

        $query = "
            SELECT 
                DATE_FORMAT(fondos_debitos.fecha, '%Y-%m-%d') 'orden',
                SUM(fondos_debitos.monto) 
            FROM 
                fondos_debitos 
            WHERE 
                fondos_debitos.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                AND 
                fondos_debitos.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
                AND 
                fondos_debitos.fondo = ".$_REQUEST['valor']." 
            GROUP BY
                orden";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        $Debitos = array();
        $i = 0;

        while ($Row = mysql_fetch_array($Result)) {
            $Debitos[$i]['fecha'] = rotateDate($Row[0]);
            $Debitos[$i]['monto'] = $Row[1];
            $i++;
        }

        $query = "
            SELECT 
                DATE_FORMAT(cobros.fecha, '%Y-%m-%d') 'orden',
                SUM(cobros.monto)
            FROM 
                cobros 
            WHERE 
                cobros.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                AND 
                cobros.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
                AND 
                cobros.fondo = ".$_REQUEST['valor']." 
            GROUP BY
                orden";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        $Cobros = array();
        $i = 0;

        while ($Row = mysql_fetch_array($Result)) {
            $Cobros[$i]['fecha'] = rotateDate($Row[0]);
            $Cobros[$i]['monto'] = $Row[1];
            $i++;
        }

        $query = "
            SELECT
                DATE_FORMAT(pagos.fecha, '%Y-%m-%d') 'orden',
                SUM(pagos.monto)  
            FROM 
                pagos 
            WHERE 
                pagos.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                AND 
                pagos.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
                AND 
                pagos.fondo = ".$_REQUEST['valor']." 
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
        $IndiceCompra = sizeof($Compras) - 1;
        $IndiceCredito = sizeof($Creditos) - 1;
        $IndiceDebito = sizeof($Debitos) - 1;
        $IndicePago = sizeof($Pagos) - 1;
        $IndiceCobro = sizeof($Cobros) - 1;
        
        $i = $Intervalo->format('%a') - 1;

        $Data = array();
        $Data[$i]['label'] = $Fecha->format('d-m-Y');
        $Data[$i]['value'] = $Saldo[0];
        
        do {

            $i--;
            $Fecha->sub(new DateInterval('P1D'));
            $Data[$i]['label'] = $Fecha->format('d-m-Y');
            $Data[$i]['value'] = $Data[$i + 1]['value'];
            if ($IndiceVenta >= 0 && !strcmp($Ventas[$IndiceVenta]['fecha'], rotateDate($Data[$i]['label']))) {
                $Data[$i]['value'] -= $Ventas[$IndiceVenta]['monto'];
                $IndiceVenta--;
            }
            if ($IndiceCompra >= 0 && !strcmp($Compras[$IndiceCompra]['fecha'], rotateDate($Data[$i]['label']))) {
                $Data[$i]['value'] += $Compras[$IndiceCompra]['monto'];
                $IndiceCompra--;
            }
            if ($IndicePago >= 0 && !strcmp($Pagos[$IndicePago]['fecha'], rotateDate($Data[$i]['label']))) {
                $Data[$i]['value'] += $Pagos[$IndicePago]['monto'];
                $IndicePago--;
            }
            if ($IndiceCobro >= 0 && !strcmp($Cobros[$IndiceCobro]['fecha'], rotateDate($Data[$i]['label']))) {
                $Data[$i]['value'] -= $Cobros[$IndiceCobro]['monto'];
                $IndiceCobro--;
            }
            if ($IndiceCredito >= 0 && !strcmp($Creditos[$IndiceCredito]['fecha'], rotateDate($Data[$i]['label']))) {
                $Data[$i]['value'] -= $Creditos[$IndiceCredito]['monto'];
                $IndiceCredito--;
            }
            if ($IndiceDebito >= 0 && !strcmp($Debitos[$IndiceDebito]['fecha'], rotateDate($Data[$i]['label']))) {
                $Data[$i]['value'] += $Debitos[$IndiceDebito]['monto'];
                $IndiceDebito--;
            }

        } while ($i > 0);

        $Data = array_reverse($Data);

        $Datos = "";

        foreach ($Data as $Value) {
            $Datos .= $Value['value'].",";
        }
        
        $Datos = substr($Datos, 0, strlen($Datos) - 1);

    ?>

    <script>

        $(function () {

            var chart;

            $(document).ready(function() {
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: 'grafico',
                        spacingRight: 20
                    },
                    title: {
                        text: '<b>Desarrollo del saldo de fondo</b>'
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: 'Fecha'
                        }
                    },
                    yAxis: {
                        title: {
                            text: 'Saldo'
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
                            name: 'Monto',
                            data: [ <?php print $Datos; ?> ]
                        }
                    ]
                });

            });

        });

    </script>
        
<?php } ?>