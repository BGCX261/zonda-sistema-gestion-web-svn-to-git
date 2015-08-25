<div>
    
    <h1>Resumen de clientes</h1>

    <?php
    
        include ('include/util.php');
        
        include ('include/form_fechas.php');
    
    ?>
    
</div>

<div>
    
    <div id="grafico-diario" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $FechaInicio = strtotime(date(rotateDate($_REQUEST['fecha-inicio'])));
    $FechaFin = strtotime(date(rotateDate($_REQUEST['fecha-fin'])));

    $Intervalo = $FechaFin - $FechaInicio;
    
    if ($Intervalo < 0) {
        return;
    }
    
    $Fecha = $FechaFin;
    
    $query = "
        SELECT
            SUM(clientes.saldo)
        FROM
            clientes";
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    $Saldo = mysql_fetch_array($Result);
    
    $query = "
        SELECT
            DATE_FORMAT(ventas.fecha, '%Y-%m-%d') 'orden',
            SUM(ventas.monto) 
        FROM 
            ventas  
        WHERE 
            ventas.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00'
            AND
            ventas.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59'  
        GROUP BY
            orden
        ORDER BY
            orden";
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        sql_error_msg();
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
            DATE_FORMAT(cobros.fecha, '%Y-%m-%d') 'orden',
            SUM(cobros.monto) 
        FROM
            cobros
        WHERE 
            cobros.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00'
            AND
            cobros.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
        GROUP BY
            orden
        ORDER BY
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
    $i = floor($Intervalo / (24*60*60)) - 1;
    print $i;

    $Data = array();
    $Data[$i]['label'] = date('d-m-Y', $Fecha);
    $Data[$i]['value'] = $Saldo[0];

    do {

        $i--;
        $Fecha -= 24*60*60;
        $Data[$i]['label'] = date('d-m-Y', $Fecha);
        $Data[$i]['value'] = $Data[$i + 1]['value'];
        if ($IndiceVenta >= 0 && !strcmp($Ventas[$IndiceVenta]['fecha'], $Data[$i]['label'])) {
            $Data[$i]['value'] -= $Ventas[$IndiceVenta]['monto'];
            $IndiceVenta--;
        }
        if ($IndicePago >= 0 && !strcmp($Pagos[$IndicePago]['fecha'], $Data[$i]['label'])) {
            $Data[$i]['value'] += $Pagos[$IndicePago]['monto'];
            $IndicePago--;
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
                    renderTo: 'grafico-diario',
                    spacingRight: 20
                },
                title: {
                    text: '<b>Desarrollo del saldo de clientes</b>'
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
                        pointStart: Date.UTC(<?php print date('Y', $FechaInicio).','.(date('n', $FechaInicio) - 1).','.date('d', $FechaInicio); ?>)
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
        
<div>
    
    <div id="grafico-saldos" class="grafico">
         <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT razon FROM clientes ORDER BY razon";
    
    $ConsultaGrafico = "
        SELECT
            clientes.razon,
            clientes.saldo 
        FROM
            clientes
        ORDER BY
            clientes.razon";
    
    $IdGrafico = 'grafico-saldos';
    
    $TituloGrafico = '<b>Saldos de clientes</b>';
    
    $TituloEjeY = 'Saldo';
    
    $TituloData = 'Monto';
    
    include_once('include/grafico_barras.php');
    
?>

<div>
    
    <div id="torta-saldos" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT razon FROM clientes ORDER BY razon";
    
    $ConsultaGrafico = "
        SELECT
            clientes.razon,
            clientes.saldo
        FROM
            clientes";
    
    $IdGrafico = 'torta-saldos';
    
    $TituloGrafico = '<b>Composición de la deuda</b>';
    
    $TituloData = 'Monto';
    
    include_once('include/grafico_torta.php');

?>

<div>
    
    <div id="torta-totales" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT razon FROM clientes ORDER BY razon";
    
    $ConsultaGrafico = "
        SELECT
            clientes.razon,
            clientes.total
        FROM
            clientes";
    
    $IdGrafico = 'torta-totales';
    
    $TituloGrafico = '<b>Composición de las ventas</b>';
    
    $TituloData = 'Monto';
    
    include_once('include/grafico_torta.php');

?>

<div>
    
    <div id="grafico-categorias" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT categorias.categoria FROM categorias ORDER BY categorias.categoria";
    
    $ConsultaGrafico = "
        SELECT
            categorias.categoria,
            SUM(ventas.saldo) 
        FROM
            ventas,
            ventas_detalle, 
            articulos, 
            categorias
        WHERE 
            ventas_detalle.venta = ventas.codigo
            AND 
            ventas_detalle.articulo = articulos.codigo
            AND 
            articulos.categoria = categorias.codigo  
        GROUP BY
            categorias.categoria
        ORDER BY
            categorias.categoria";
    
    $IdGrafico = 'grafico-categorias';
    
    $TituloGrafico = '<b>Saldos de cliente por categoría</b>';
    
    $TituloEjeY = 'Saldo';
    
    $TituloData = 'Monto';
    
    include_once('include/grafico_barras.php');

?>

<div>
    
    <div id="grafico-pagos" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $ConsultaGrafico = "
        SELECT 
            DATE_FORMAT(cobros.fecha, '%Y-%m-%d') 'orden', 
            SUM(cobros.monto) 
        FROM 
            cobros 
        WHERE 
            cobros.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            cobros.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY 
            orden";
    
    $IdGrafico = 'grafico-pagos';
    
    $TituloGrafico = '<b>Pagos realizados</b>';
    
    $TituloEjeX = 'Fecha';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto del pago';
    
    include_once('include/grafico_lineal_fechas.php');

?>

<div class="tabla-informe">
    
    <?php

        $query = "
            SELECT
                LPAD(clientes.codigo, 12, 0),
                clientes.razon,
                clientes.saldo,
                clientes.total
            FROM
                clientes 
            ORDER BY 
                saldo DESC 
            LIMIT
                0, 10";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        if (mysql_numrows($Result) > 0) {

            print '<h2 class="titulo-grafico">Los diez clientes con más deuda</h2>';

            print '<div id="mas-deudores" class="lista-tabla">';

            $i = 0;
            $Data = array();

            while ($Row = mysql_fetch_array($Result)) {
                $Data[$i]['codigo'] = $Row[0];
                $Data[$i]['razon'] = $Row[1];
                $Data[$i]['saldo'] = $Row[2];
                $Data[$i]['total'] = $Row[3];
                $i++;
            }

            $Tabla = '<table class="mini-listado" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th width="15%">Código</th>
                        <th width="45%">Razón social</th>      
                        <th width="20%">Saldo de la cuenta</th>
                        <th width="20%">Total de compras</th>
                    </tr>
                </thead>
                <tbody>';

            for ($i = 0; $i < sizeof($Data); $i++) {
                $Tabla .= '<tr class="';
                $i % 2 == 0 ? $Tabla .= "even" : $Tabla .= "odd";
                $Tabla .= '">
                        <td>'.$Data[$i]['codigo'].'</td>
                        <td>'.$Data[$i]['razon'].'</td>
                        <td align="right">$'.$Data[$i]['saldo'].'</td>
                        <td align="right">$'.$Data[$i]['total'].'</td>
                    </tr>';
            }

            $Tabla .= '</tbody></table>';

            print $Tabla;

            print '</div>';

        }

    ?>
    
</div>

<div class="tabla-informe">
        
    <?php

        $query = "
            SELECT
                LPAD(clientes.codigo, 12, 0),
                clientes.razon,
                clientes.saldo,
                clientes.total,
                DATEDIFF('".rotateDate($_REQUEST['fecha-fin'])."', MAX(cobros.fecha)) retraso
            FROM 
                clientes,
                cobros,
                ventas
            WHERE 
                ventas.saldo > 0 
                AND
                cobros.operacion = ventas.codigo 
                AND 
                ventas.cliente = clientes.codigo
                AND
                ventas.fecha > ".rotateDate($_REQUEST['fecha-fin'])." 
            GROUP BY
                clientes.codigo

            UNION

            SELECT
                LPAD(clientes.codigo, 12, 0),
                clientes.razon,
                clientes.saldo,
                clientes.total,
                '∞'
            FROM
                clientes
            WHERE
                clientes.codigo NOT IN (
                    SELECT
                        clientes.codigo
                    FROM
                        clientes,
                        ventas,
                        cobros 
                    WHERE
                        ventas.cliente = clientes.codigo
                        AND
                        ventas.saldo > 0 
                        AND
                        cobros.operacion = ventas.codigo 
                )

            ORDER BY 
                retraso DESC 
            LIMIT 
                0, 10";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        if (mysql_numrows($Result) > 0) {

            print '<h2 class="titulo-grafico">Los diez clientes más retrasados en el pago</h2>';

            print '<div id="mas-retrasados" class="lista-tabla">';

            $i = 0;
            $Data = array();

            while ($Row = mysql_fetch_array($Result)) {
                $Data[$i]['codigo'] = $Row[0];
                $Data[$i]['razon'] = $Row[1];
                $Data[$i]['saldo'] = $Row[2];
                $Data[$i]['total'] = $Row[3];
                $Data[$i]['retraso'] = $Row[4];
                $i++;
            }

            $Tabla = '<table class="mini-listado" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th width="15%">Código</th>
                        <th width="40%">Razón social</th>      
                        <th width="15%">Saldo de la cuenta</th>
                        <th width="15%">Total de compras</th>
                        <th width="15%">Retraso en el pago</th>
                    </tr>
                </thead>
                <tbody>';

            for ($i = 0; $i < sizeof($Data); $i++) {
                $Tabla .= '<tr class="';
                $i % 2 == 0 ? $Tabla .= "even" : $Tabla .= "odd";
                $Tabla .= '">
                        <td>'.$Data[$i]['codigo'].'</td>
                        <td>'.$Data[$i]['razon'].'</td>
                        <td align="right">$'.$Data[$i]['saldo'].'</td>
                        <td align="right">$'.$Data[$i]['total'].'</td>
                        <td align="right">'.$Data[$i]['retraso'].' días</td>
                    </tr>';
            }

            $Tabla .= '</tbody></table>';

            print $Tabla;

            print '</div>';

        }

    ?>
    
</div>
        
<div class="tabla-informe">
        
    <?php

        $query = "
            SELECT
                LPAD(clientes.codigo, 12, 0),
                clientes.razon,
                SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto'
            FROM
                clientes,
                ventas_detalle,
                ventas 
            WHERE
                ventas.cliente = clientes.codigo 
                AND 
                ventas.codigo = ventas_detalle.venta
                AND
                ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                AND
                ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            GROUP BY
                ventas.cliente 
            ORDER BY
                monto DESC
            LIMIT
                0, 10";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        if (mysql_numrows($Result) > 0) {

            print '<h2 class="titulo-grafico">Los diez mayores clientes</h2>';

            print '<div id="mayores-clientes" class="lista-tabla">';

            $i = 0;
            $Data = array();

            while ($Row = mysql_fetch_array($Result)) {
                $Data[$i]['codigo'] = $Row[0];
                $Data[$i]['razon'] = $Row[1];
                $Data[$i]['monto'] = $Row[2];
                $Data[$i]['porcentaje'] = 0;
                $i++;
            }

            $query = "
                SELECT
                    SUM(ventas.monto)
                FROM
                    ventas 
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($query);

            if (!$Result) {
                sql_error_msg();
                return;
            }

            if (mysql_numrows($Result) > 0) {

                $Row = mysql_fetch_array($Result);

                $Tabla = '<table class="mini-listado" cellpadding="0" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Razón social</th>
                            <th>Monto comprado</th>
                            <th>Porcentaje del total</th>
                        </tr>
                    </thead>
                    <tbody>';

                for ($i = 0; $i < sizeof($Data); $i++) {
                    $Data[$i]['porcentaje'] = number_format($Data[$i]['monto'] / $Row[0] * 100, 2).'%';
                    $Data[$i]['monto'] = '$'.$Data[$i]['monto'];
                    $Tabla .= '<tr class="';
                    $i % 2 == 0 ? $Tabla .= "even" : $Tabla .= "odd";
                    $Tabla .= '">
                            <td width="20%">'.$Data[$i]['codigo'].'</td>
                            <td width="60%">'.$Data[$i]['razon'].'</td>
                            <td width="10%" align="right">'.$Data[$i]['monto'].'</td>
                            <td width="10%" align="right">'.$Data[$i]['porcentaje'].'</td>
                        </tr>';
                }

                $Tabla .= '</tbody></table>';

                print $Tabla;

                print '</div>';
                
            }

        }

    ?>

</div>