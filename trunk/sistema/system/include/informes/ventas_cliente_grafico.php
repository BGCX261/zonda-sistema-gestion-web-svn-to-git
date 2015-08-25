<div>
    
    <h1>Desarrollo de ventas por cliente</h1>
    
    <?php
    
        include ('include/util.php');
    
        if (!isset($_REQUEST['impresion'])) { 
            
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

        }
        else {

            print '<h2>Desde el '.$_REQUEST['fecha-inicio'].' al '.$_REQUEST['fecha-fin'].'</h2>';

        }
    
    ?>
    
</div>

<div id="grafico1" class="grafico">
    
    <!-- AQUI VA EL GRAFICO GENERADO -->

</div>

<div id="grafico2" class="grafico">
    
    <!-- AQUI VA EL GRAFICO GENERADO -->

</div>

<?php

    $ConsultaGrafico = "
        SELECT
            DATE_FORMAT(ventas.fecha, '%Y-%m-%d'),
            ventas_detalle.cantidad, 
            ventas_detalle.cantidad * ventas_detalle.precio 
        FROM
            ventas_detalle,
            ventas
        WHERE 
            ventas_detalle.venta = ventas.codigo
            AND 
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            AND 
            ventas.cliente = ".$_REQUEST['valor'];
    
    $TituloGrafico1 = 'Cantidad de artículos vendidos por fecha';
    
    $TituloEjeX1 = 'Fecha';
    
    $TituloEjeY1 = 'Cantidad';
    
    $TituloData1 = 'Cantidad vendida';
    
    $TituloGrafico2 = 'Monto facturado por fecha';
    
    $TituloEjeX2 = 'Fecha';
    
    $TituloEjeY2 = 'Monto';
    
    $TituloData2 = 'Monto facturado';
    
    include_once('include/grafico_lineal_fechas_doble.php');
    
?>