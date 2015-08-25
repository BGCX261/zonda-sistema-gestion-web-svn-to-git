<div>

    <h1>Desarrollo de pagos realizados por cliente</h1>
    
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
    
    $ConsultaGrafico = "
        SELECT
            DATE_FORMAT(cobros.fecha, '%Y-%m-%d'), 
            cobros.monto 
        FROM
            cobros
        WHERE 
            cobros.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            cobros.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            AND 
            cobros.cliente = ".$_REQUEST['valor'];
    
    $TituloGrafico = 'Pagos realizados por fecha';
    
    $TituloEjeX = 'Fecha';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto pagado';
    
    include_once('include/grafico_lineal_fechas.php');
    
?>