<?php

    /*
     * PERMITE CREAR UN GRAFICO EN LA PANTALLA.
     * 
     * $ConsultaGrafico contiene la consulta SQL con los datos:
     * 
     *      Dia de la semana
     *      Parametro grafico
     */
     
    $Data = array();
    
    /* PARA PHP >= 5.3.0:
    
    $FechaInicio = date_create(rotateDate($_REQUEST['fecha-inicio']));
    $FechaFin = date_create(rotateDate($_REQUEST['fecha-fin']));
    
    $Intervalo = $FechaFin->diff($FechaInicio);
    
    if (strcmp($Intervalo->format('%R'), '-')) {
        return;
    }*/
    
    /* PARA PHP < 5.3.0: */
    
    $FechaInicio = date(rotateDate($_REQUEST['fecha-inicio']).'00:00:00');
    $FechaFin = date(rotateDate($_REQUEST['fecha-fin']).'00:00:00');
    
    $Intervalo = strtotime($FechaFin) - strtotime($FechaInicio);
    
    if ($Intervalo < 0) {
        return;
    }
    
    /* FIN FECHAS */
    
    for ($i = 0; $i < 7; $i++) {
        $Data[$i]['label'] = $i;
        $Data[$i]['value'] = '0';
    }
    
    $Result = mysql_query($ConsultaGrafico);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    if (mysql_numrows($Result) > 0) {
    
        $Row = mysql_fetch_array($Result);

        for ($i = 0; $i < 7; $i++) {
            if ($Row[0] == $i) {
                $Data[$i]['value'] = $Row[1];
                $Row = mysql_fetch_array($Result);
            }
        }

        $Data[0]['label'] = 'Domingo';
        $Data[1]['label'] = 'Lunes';
        $Data[2]['label'] = 'Martes';
        $Data[3]['label'] = 'Miércoles';
        $Data[4]['label'] = 'Jueves';
        $Data[5]['label'] = 'Viernes';
        $Data[6]['label'] = 'Sábado';

        if (!isset($IdGrafico)) {
            $IdGrafico = 'grafico';
        }

        $Categorias = "";
        $Datos = "";

        for ($i = 0; $i < sizeof($Data); $i++) {
            if ($i > 0) {
                $Categorias .= ", ";
                $Datos .= ", ";
            }
            $Categorias .= "'".$Data[$i]['label']."'";
            $Datos .= $Data[$i]['value'];
        }

    ?>

    <script>

        $(function () {
            var chart;
            $(document).ready(function() {
                chart = new Highcharts.Chart({
                    chart: {
                        renderTo: '<?php print $IdGrafico; ?>',
                        type: 'column',
                        margin: [ 50, 50, 100, 80]
                    },
                    title: {
                        text: '<?php print $TituloGrafico; ?>'
                    },
                    xAxis: {
                        categories: [
                            <?php print $Categorias; ?>
                        ],
                        labels: {
                            rotation: -45,
                            align: 'right',
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: '<?php print $TituloEjeY; ?>'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    series: [{
                        name: '<?php print $TituloData; ?>',
                        data: [ <?php print $Datos; ?> ],
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            x: -3,
                            y: 10,
                            formatter: function() {
                                return this.y;
                            },
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
            });

        });

    </script>
    
<?php } ?>