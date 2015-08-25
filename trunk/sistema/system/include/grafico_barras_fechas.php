<?php

    /*
     * PERMITE CREAR UN GRAFICO EN LA PANTALLA.
     * 
     * $ConsultaGrafico contiene la consulta SQL con los datos:
     * 
     *      Fecha
     *      Parametro grafico
     */

    $i = 0;
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
    
    $Result = mysql_query($ConsultaGrafico);
    
    if (!$Result) {
        sql_error_msg();
        return;
    }
    
    if (mysql_numrows($Result) > 0) {
    
        $Row = mysql_fetch_array($Result);

        $Fecha = strtotime($FechaInicio);
        $Fin = strtotime($FechaFin);
        
        while ($Fecha <= $Fin) {

            /*$Data[$i]['label'] = $Fecha->format('d-m-Y');*/
            $Data[$i]['label'] = date('d-m-Y', $Fecha);
            $Data[$i]['value'] = 0;
            /*if (!strcmp($Row[0], $Fecha->format('Y-m-d'))) {*/
            if (!strcmp($Row[0], date('Y-m-d', $Fecha))) {
                $Data[$i]['value'] = $Row[1];
                $Row = mysql_fetch_array($Result);
            }
            /*$Fecha->add(new DateInterval('P1D'));*/
            $Fecha += 24*60*60;
            /*$Intervalo = $FechaFin->diff($Fecha);*/
            $i++;

        /*} while (strcmp($Intervalo->format('%a'), '0'));*/
        }

        $Json = json_encode($Data);

    ?>

    <script>

        var jsonData = <?php print $Json; ?>;

        var dataLabels = [];
        var dataSeries = [];

        for(var i in jsonData) {
            dataSeries.push(
               {
                  data: [[i, jsonData[i].value]],
                  bars:
                     {
                        show: true,
                        barWidth: 0.4,
                        align: "center"
                     }
               });
            dataLabels.push([i, jsonData[i].label]);
         }

         $.plot($('#<?php isset($NombreGrafico) ? print $NombreGrafico : print 'grafico'; ?>'), dataSeries,
            {
               xaxis: {
                  ticks: dataLabels
               },
               colors: paletaColores
            }
         );

        for(var i in jsonData) {
            dataLabels.push([i, jsonData[i].label]);
            dataSeries.push([i, jsonData[i].value]);
        }

    </script>
    
<?php } ?>