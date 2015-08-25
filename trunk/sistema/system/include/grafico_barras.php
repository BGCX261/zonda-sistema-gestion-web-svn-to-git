<?php

    /*
     * PERMITE CREAR UN GRAFICO EN LA PANTALLA.
     * 
     * $EtiquetaGrafico contiene la consulta SQL con las etiquetas.
     * 
     * $ConsultaGrafico contiene la consulta SQL con los datos:
     * 
     *      Etiqueta
     *      Parametro grafico
     * 
     * Y debe estar ordenado por valor creciente de parametro.
     */

    $i = 0;
    $Data = array();
    
    $Result = mysql_query($EtiquetasGrafico);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    if (mysql_numrows($Result) > 0) {
        
        $Etiquetas = array();

        while ($Row = mysql_fetch_array($Result)) {
            $Etiquetas[] = $Row[0];
        }

        $Result = mysql_query($ConsultaGrafico);

        if (!$Result) {
            sql_error_msg();
            return;
        }
        
        if (mysql_numrows($Result) > 0) {

            $SortedData = array();

            while ($Row = mysql_fetch_array($Result)) {
                $SortedData[$Row[0]] = $Row[1];
            }

            $SortedDataKeys = array_keys($SortedData);
            
            if (sizeof($SortedData) > 9) {
                for ($i = 0; $i < 9; $i++) {
                    $Data[$i]['label'] = $SortedDataKeys[$i];
                    $Data[$i]['value'] = $SortedData[$SortedDataKeys[$i]];
                }
                $TotalOtros = 0;
                for (; $i < sizeof($SortedData); $i++) {
                    $TotalOtros += $SortedData[$SortedDataKeys[$i]];
                }
                $Data[9]['label'] = 'Otros';
                $Data[9]['value'] = $TotalOtros;
            }
            else {
                for ($i = 0; $i < sizeof($SortedData); $i++) {
                    $Data[$i]['label'] = $SortedDataKeys[$i];
                    $Data[$i]['value'] = $SortedData[$SortedDataKeys[$i]];
                }
            }
            
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
    
<?php } } ?>