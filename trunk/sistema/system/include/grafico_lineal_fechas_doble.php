<?php

    /*
     * PERMITE CREAR UN GRAFICO EN LA PANTALLA.
     * 
     * $ConsultaGrafico contiene la consulta SQL con los datos:
     * 
     *      Fecha
     *      Parametro grafico 1
     *      Parametro grafico 2
     */

    $FechaInicio = date(rotateDate($_REQUEST['fecha-inicio']));
    $FechaFin = date(rotateDate($_REQUEST['fecha-fin']));
    
    $Intervalo = strtotime($FechaFin) - strtotime($FechaInicio);
    
    if ($Intervalo < 0) {
        return;
    }
    
    $Result = mysql_query($ConsultaGrafico);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    if (mysql_numrows($Result) > 0) {
    
        $Row = mysql_fetch_array($Result);
        
        $i = 0;

        $Fecha = strtotime($FechaInicio);
        $Fin = strtotime($FechaFin);

        $Data1 = "";
        $Data2 = "";

        while ($Fecha <= $Fin) {

            if ($i > 0) {
                $Data1 .= ", ";
                $Data2 .= ", ";
            }
            if (!strcmp($Row[0], date('Y-m-d', $Fecha))) {
                $Data1 .= is_null($Row[1]) ? "0" : $Row[1];
                $Data2 .= is_null($Row[1]) ? "0" : $Row[1] * $Row[2];
                $Row = mysql_fetch_array($Result);
            }
            else {
                $Data1 .= "0";
                $Data2 .= "0";
            }
            $Fecha += 24*60*60;
            $i++;

        }

        $FechaInicio = strtotime($FechaInicio);
        
    ?>

    <script>

        $(function () {

            var chart1;

            $(document).ready(function() {
                chart1 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'grafico1',
                        spacingRight: 20
                    },
                    title: {
                        text: '<?php print $TituloGrafico1; ?>'
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: '<?php print $TituloEjeX1; ?>'
                        }
                    },
                    yAxis: {
                        title: {
                            text: '<?php print $TituloEjeY1; ?>'
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
                            name: '<?php print $TituloData1; ?>',
                            data: [ <?php print $Data1; ?> ]
                        }
                    ]
                });

            });

            var chart2;

            $(document).ready(function() {
                chart2 = new Highcharts.Chart({
                    chart: {
                        renderTo: 'grafico2',
                        spacingRight: 20
                    },
                    title: {
                        text: '<?php print $TituloGrafico2; ?>'
                    },
                    xAxis: {
                        type: 'datetime',
                        title: {
                            text: '<?php print $TituloEjeX2; ?>'
                        }
                    },
                    yAxis: {
                        title: {
                            text: '<?php print $TituloEjeY2; ?>'
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
                            name: '<?php print $TituloData2; ?>',
                            data: [ <?php print $Data2; ?> ]
                        }
                    ]
                });
            });

        });

    </script>
    
<?php } ?>