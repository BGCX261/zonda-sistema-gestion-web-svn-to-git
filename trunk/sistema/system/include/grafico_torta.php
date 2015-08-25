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

            $TotalTorta = 0;

            for ($i = 0; $i < sizeof($Data); $i++) {
                $TotalTorta += $Data[$i]['value'];
            }

            if (!isset($IdGrafico)) {
                $IdGrafico = 'grafico';
            }

            $Datos = "";

            for ($i = 0; $i < sizeof($Data); $i++) {
                if ($i > 0) {
                    $Datos .= ", ";
                }
                if ($TotalTorta > 0) {
                    $Datos .= "[ '".$Data[$i]['label']."', ".round($Data[$i]['value'] / $TotalTorta * 100, 2)." ]";
                }
                else {
                    $Datos .= "[ '".$Data[$i]['label']."', 0 ]";
                }
            }

        ?>

        <script>

            $(function () {
                var chart;
                $(document).ready(function() {
                    chart = new Highcharts.Chart({
                        chart: {
                            renderTo: '<?php print $IdGrafico; ?>',
                            plotBackgroundColor: null,
                            plotBorderWidth: null,
                            plotShadow: false
                        },
                        title: {
                            text: '<?php print $TituloGrafico; ?>'
                        },
                        tooltip: {
                            formatter: function() {
                                return '<b>'+ this.point.name +'</b>: '+ Number(this.percentage).toFixed() +' %';
                            }
                        },
                        plotOptions: {
                            pie: {
                                allowPointSelect: true,
                                cursor: 'pointer',
                                dataLabels: {
                                    enabled: true,
                                    color: '#000000',
                                    connectorColor: '#000000',
                                    formatter: function() {
                                        return '<b>'+ this.point.name +'</b>: '+ Number(this.percentage).toFixed() +' %';
                                    }
                                }
                            }
                        },
                        series: [{
                            type: 'pie',
                            name: '<?php print $TituloData; ?>',
                            data: [ <?php print $Datos; ?> ]
                        }]
                    });
                });

            });

        </script>
    
<?php } } ?>