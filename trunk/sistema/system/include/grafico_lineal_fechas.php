<?php

    /*
     * PERMITE CREAR UN GRAFICO EN LA PANTALLA.
     * 
     * $ConsultaGrafico contiene la consulta SQL con los datos:
     * 
     *      Fecha
     *      Parametro grafico
     */

    $Data = "";
    
    /* PARA PHP >= 5.3.0:
    
    $FechaInicio = date_create(rotateDate($_REQUEST['fecha-inicio']));
    $FechaFin = date_create(rotateDate($_REQUEST['fecha-fin']));
    
    $Intervalo = $FechaFin->diff($FechaInicio);
    
    if (strcmp($Intervalo->format('%R'), '-')) {
        return;
    }*/
    
    /* PARA PHP < 5.3.0: */
    
    $FechaInicio = date(rotateDate($_REQUEST['fecha-inicio']));
    $FechaFin = date(rotateDate($_REQUEST['fecha-fin']));
    
    $Intervalo = strtotime($FechaFin) - strtotime($FechaInicio);
    
    if ($Intervalo < 0) {
        return;
    }
    
    /* FIN FECHAS */
    
    $Result = mysql_query($ConsultaGrafico);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    if (mysql_numrows($Result) > 0) {
        
        $Row = mysql_fetch_array($Result);

        $i = 0;

        /*$Fecha = $FechaInicio;*/
        $Fecha = strtotime($FechaInicio);
        $Fin = strtotime($FechaFin);
        
        while ($Fecha <= $Fin) {
            
            if ($i > 0) {
                $Data .= ", ";
            }
            /*if (!strcmp($Row[0], $Fecha->format('Y-m-d'))) {*/
            
            if (!strcmp($Row[0], date('Y-m-d', $Fecha))) {
                $Data .= $Row[1];
                $Row = mysql_fetch_array($Result);
            }
            else {
                $Data .= "0";
            }
            /*$Fecha->add(new DateInterval('P1D'));*/
            $Fecha += 24*60*60;
            /*$Intervalo = $FechaFin->diff($Fecha);*/
            /*$Intervalo = strtotime($FechaFin) - $Fecha;*/
            $i++;

        /*} while (strcmp($Intervalo->format('%a'), '0'));*/
        } 
        
        /*print 'danidanidanidani';*/

        if (!isset($IdGrafico)) {
            $IdGrafico = 'grafico';
        }

        /*$FechaInicio = date_create(rotateDate($_REQUEST['fecha-inicio']));*/
        $FechaInicio = strtotime($FechaInicio);
        
    ?>

    <script>

        $(function () {

            var chart;

            $(document).ready(function() {
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: '<?php print $IdGrafico; ?>',
                        spacingRight: 20
                    },
                    title: {
                        text: '<?php print $TituloGrafico; ?>'
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: '<?php print $TituloEjeX; ?>'
                        }
                    },
                    yAxis: {
                        title: {
                            text: '<?php print $TituloEjeY; ?>'
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
                            pointStart: Date.UTC(<?php print date('Y', $FechaInicio).','.(date('n', $FechaInicio) - 1).','.date('d', $FechaInicio);/*$FechaInicio->format('Y, m - 1, d')*/ ?>)
                        }
                    },
                    series: [ {
                            type: 'area',
                            name: '<?php print $TituloData; ?>',
                            data: [ <?php print $Data; ?> ]
                        }
                    ]
                });

            });

        });

    </script>
    
<?php } ?>