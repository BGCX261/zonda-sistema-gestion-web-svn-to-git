<div>
    
    <h1>Resumen de las compras</h1>

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
    
    $ConsultaGrafico = "
        SELECT
            DATE_FORMAT(compras.fecha, '%Y-%m-%d') 'dia',
            SUM(compras.monto)
        FROM
            compras 
        WHERE
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY
            dia";
    
    $IdGrafico = 'grafico-diario';
    
    $TituloGrafico = 'Monto de compras realizadas por fecha';
    
    $TituloEjeX = 'Fecha';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto de las compras';
    
    include_once('include/grafico_lineal_fechas.php');
    
?>

<div>
    
    <div id="grafico-categoria" class="grafico">
         <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT categorias.categoria FROM categorias ORDER BY categorias.categoria";
    
    $ConsultaGrafico = "
        SELECT
            categorias.categoria,
            SUM(compras_detalle.cantidad * compras_detalle.precio) 'monto'
        FROM
            compras_detalle,
            articulos,
            categorias
        WHERE
            compras_detalle.compra IN (
                SELECT
                    compras.codigo
                FROM
                    compras
                WHERE
                    compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            )  
            AND
            compras_detalle.articulo = articulos.codigo
            AND
            articulos.categoria = categorias.codigo  
        GROUP BY
            categorias.categoria
        ORDER BY
            monto DESC";
    
    $IdGrafico = 'grafico-categoria';
    
    $TituloGrafico = 'Compras realizadas por categoría';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto de las compras';
    
    include_once('include/grafico_barras.php');
    
?>

<div>
    
    <div id="torta-categoria" class="grafico">
         <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php
    
    $IdGrafico = 'torta-categoria';
    
    $TituloGrafico = 'Compras por categoría';
    
    $TituloData = 'Monto de las compras';
    
    include_once('include/grafico_torta.php');
    
?>

<div>
    
    <div id="torta-proveedor" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT proveedores.razon FROM proveedores ORDER BY proveedores.razon";
    
    $ConsultaGrafico = "
        SELECT
            proveedores.razon,
            SUM(compras_detalle.cantidad * compras_detalle.precio) 'monto' 
        FROM
            compras_detalle,
            proveedores,
            compras 
        WHERE
            compras_detalle.compra IN (
                SELECT
                    compras.codigo
                FROM
                    compras
                WHERE
                    compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'  
            )  
            AND
            compras_detalle.compra = compras.codigo
            AND
            compras.proveedor = proveedores.codigo  
        GROUP BY
            proveedores.razon
        ORDER BY
            monto DESC";
    
    $IdGrafico = 'torta-proveedor';
    
    $TituloGrafico = 'Compras por proveedor';
    
    $TituloData = 'Monto de las compras';
    
    include_once('include/grafico_torta.php');
    
?>

<div>
        
    <div id="promedio-compras" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $ConsultaGrafico = "
        SELECT
            DATE_FORMAT(compras.fecha, '%w') 'dia',
            SUM(compras.monto)
        FROM
            compras 
        WHERE
            compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY
            dia
        ORDER BY
            dia";

    $IdGrafico = "promedio-compras";
    
    $TituloGrafico = 'Compras realizadas por día de la semana';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto de las compras';
    
    include_once('include/grafico_barras_dia.php');
    
?>

<div>
    
    <div id="total-compras" class="totales-informe total-izquierda">
    
        <h3 class="titulo-total">Total de compras</h3>
        
        <?php

            $ConsultaGrafico = "
                SELECT
                    SUM(compras.monto)
                FROM
                    compras 
                WHERE
                    compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);

            $Row = mysql_fetch_array($Result);

            print '<h1>$'.$Row[0].'</h1>';

        ?>
        
    </div>
    
</div>

<div>
    
    <div id="total-deuda" class="totales-informe total-derecha">
    
        <h3 class="titulo-total">Saldo de compras</h3>
        
        <?php

            $ConsultaGrafico = "
                SELECT
                    SUM(compras.saldo)
                FROM
                    compras 
                WHERE
                    compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);
            
            if ($Result) {

                $Row = mysql_fetch_array($Result);

                print '<h1>$'.$Row[0].'</h1>';
                
            }

        ?>
        
    </div>
    
</div>

<div>
    
    <div id="promedio-compras" class="totales-informe total-izquierda">
    
        <h3 class="titulo-total">Promedio de compras</h3>
        
        <?php
        
            $FechaInicio = strtotime(date(rotateDate($_REQUEST['fecha-inicio'])));
            $FechaFin = strtotime(date(rotateDate($_REQUEST['fecha-fin'])));

            $Intervalo = $FechaFin - $FechaInicio;

            $ConsultaGrafico = "
                SELECT
                    SUM(compras.monto)
                FROM
                    compras 
                WHERE
                    compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);
            
            if ($Result) {

                $Row = mysql_fetch_array($Result);

                print '<h1>$'.number_format($Row[0] / $Intervalo / (24*60*60), 2).' por día</h1>';
                
            }

        ?>
        
    </div>
    
</div>

<div>
    
    <div id="promedio-pago" class="totales-informe total-derecha">
    
        <h3 class="titulo-total">Promedio de pagos</h3>
        
        <?php

            $ConsultaGrafico = "
                SELECT  
                    SUM(pagos.monto)
                FROM 
                    pagos, 
                    compras 
                WHERE 
                    pagos.operacion = compras.codigo 
                    AND 
                    compras.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    compras.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);
            
            if ($Result) {

                $Row = mysql_fetch_array($Result);

                print '<h1>$'.number_format($Row[0] / $Intervalo / (24*60*60), 2).' por día</h1>';
                
            }

        ?>
        
    </div>
    
</div>

<div>
        
    <?php

        $query = "
            SELECT
                LPAD(articulos.codigo, 12, 0),
                articulos.descripcion,
                categorias.categoria,
                proveedores.razon,
                SUM(compras_detalle.cantidad * compras_detalle.precio) 'monto'
            FROM
                articulos,
                categorias,
                proveedores,
                compras_detalle,
                compras 
            WHERE
                articulos.categoria = categorias.codigo
                AND
                articulos.proveedor = proveedores.codigo
                AND 
                articulos.codigo = compras_detalle.articulo
                AND
                compras.codigo = compras_detalle.compra
                AND
                compras.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00' 
                AND
                compras.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
            GROUP BY
                compras_detalle.articulo 
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

            print '<h2 class="titulo-grafico">Los diez artículos más comprados</h2>';

            print '<div id="mas-comprados" class="lista-tabla">';

            $i = 0;
            $Data = array();

            while ($Row = mysql_fetch_array($Result)) {
                $Data[$i]['codigo'] = $Row[0];
                $Data[$i]['descripcion'] = $Row[1];
                $Data[$i]['categoria'] = $Row[2];
                $Data[$i]['proveedor'] = $Row[3];
                $Data[$i]['monto'] = $Row[4];
                $Data[$i]['porcentaje'] = 0;
                $i++;
            }

            $query = "
                SELECT
                    SUM(compras.monto)
                FROM
                    compras 
                WHERE
                    compras.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00'
                    AND
                    compras.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59'";

            $Result = mysql_query($query);

            if (!$Result) {
                print mysql_error();
                return;
            }

            if (mysql_numrows($Result) < 1) {
                print '0';
                return;
            }

            $Row = mysql_fetch_array($Result);

            $Tabla = '<table class="mini-listado" cellpadding="0" cellspacing="0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción</th>      
                        <th>Categoría</th>
                        <th>Proveedor</th>
                        <th>Monto</th>
                        <th>Porcentaje</th>
                    </tr>
                </thead>
                <tbody>';

            for ($i = 0; $i < sizeof($Data); $i++) {
                $Data[$i]['porcentaje'] = number_format($Data[$i]['monto'] / $Row[0] * 100, 2);
                $Data[$i]['monto'] = '$'.$Data[$i]['monto'];
                $Data[$i]['porcentaje'] = $Data[$i]['porcentaje'].'%';
                $Tabla .= '<tr class="';
                $i % 2 == 0 ? $Tabla .= "even" : $Tabla .= "odd";
                $Tabla .= '">
                        <td width="15%">'.$Data[$i]['codigo'].'</td>
                        <td width="35%">'.$Data[$i]['descripcion'].'</td>
                        <td width="15%">'.$Data[$i]['categoria'].'</td>
                        <td width="15%">'.$Data[$i]['proveedor'].'</td>
                        <td align="right" width="10%">'.$Data[$i]['monto'].'</td>
                        <td align="right" width="10%">'.$Data[$i]['porcentaje'].'</td>
                    </tr>';
            }

            $Tabla .= '</tbody></table>';

            print $Tabla;
            
            print '</div>';

        }

    ?>

</div>

<div>
    
    <div id="torta-comprados" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT descripcion FROM articulos ORDER BY descripcion";
    
    $ConsultaGrafico = "
        SELECT 
            articulos.descripcion,
            SUM(compras_detalle.cantidad * compras_detalle.precio) 'monto'
        FROM 
            articulos,
            compras_detalle,
            compras 
        WHERE 
            articulos.codigo = compras_detalle.articulo 
            AND 
            compras.codigo = compras_detalle.compra 
            AND 
            compras.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00' 
            AND 
            compras.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
        GROUP BY 
            compras_detalle.articulo 
        ORDER BY
            monto DESC
        LIMIT
            0, 10";
    
    $IdGrafico = 'torta-comprados';
    
    $TituloGrafico = 'Los artículos más comprados';
    
    $TituloData = 'Monto de las compras';
    
    include_once('include/grafico_torta.php');
    
?>

<div class="tabla-informe">
        
    <?php

        $query = "
            SELECT
                LPAD(proveedores.codigo, 12, 0),
                proveedores.razon,
                SUM(compras_detalle.cantidad * compras_detalle.precio) 'monto'
            FROM
                proveedores,
                compras_detalle,
                compras 
            WHERE
                compras.proveedor = proveedores.codigo 
                AND 
                compras.codigo = compras_detalle.compra
                AND
                compras.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00' 
                AND
                compras.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
            GROUP BY
                compras.proveedor 
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

            print '<h2 class="titulo-grafico">Los diez mayores proveedores</h2>';

            print '<div id="mayores-proveedores" class="lista-tabla">';

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
                    SUM(compras.monto)
                FROM
                    compras 
                WHERE
                    compras.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00'
                    AND
                    compras.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59'";

            $Result = mysql_query($query);

            if (!$Result) {
                print mysql_error();
                return;
            }

            if (mysql_numrows($Result) < 1) {
                print '0';
                return;
            }

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
                $Data[$i]['porcentaje'] = number_format($Data[$i]['monto'] / $Row[0] * 100, 2);
                $Data[$i]['monto'] = '$'.$Data[$i]['monto'];
                $Data[$i]['porcentaje'] = $Data[$i]['porcentaje'].'%';
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

    ?>

</div>

<div>
    
    <div id="torta-mayores" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT proveedores.razon FROM proveedores ORDER BY proveedores.razon";
    
    $ConsultaGrafico = "
            SELECT
                proveedores.razon,
                SUM(compras_detalle.cantidad * compras_detalle.precio) 'monto'
            FROM
                proveedores,
                compras_detalle,
                compras 
            WHERE
                compras.proveedor = proveedores.codigo 
                AND 
                compras.codigo = compras_detalle.compra
                AND
                compras.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00' 
                AND
                compras.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
            GROUP BY
                compras.proveedor 
            ORDER BY
                monto DESC
            LIMIT
                0, 10";
    
    $IdGrafico = 'torta-mayores';
    
    $TituloGrafico = 'Los mayores proveedores';
    
    $TituloData = 'Monto de las compras';
    
    include_once('include/grafico_torta.php');
    
?>