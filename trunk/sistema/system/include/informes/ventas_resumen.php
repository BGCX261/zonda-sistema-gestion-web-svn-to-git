<div>
    
    <h1>Resumen de las ventas</h1>

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
            DATE_FORMAT(ventas.fecha, '%Y-%m-%d') 'dia',
            SUM(ventas.monto)
        FROM
            ventas 
        WHERE
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
            AND
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY
            dia";
    
    $IdGrafico = 'grafico-diario';
    
    $TituloGrafico = 'Monto de ventas realizadas por fecha';
    
    $TituloEjeX = 'Fecha';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto de las ventas';
    
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
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto'
        FROM
            ventas_detalle,
            articulos,
            categorias
        WHERE
            ventas_detalle.venta IN (
                SELECT
                    ventas.codigo
                FROM
                    ventas
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            )  
            AND
            ventas_detalle.articulo = articulos.codigo
            AND
            articulos.categoria = categorias.codigo  
        GROUP BY
            categorias.categoria
        ORDER BY
            monto DESC";
    
    $IdGrafico = 'grafico-categoria';
    
    $TituloGrafico = 'Ventas realizadas por categoría';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto de las ventas';
    
    include_once('include/grafico_barras.php');
    
?>

<div>
    
    <div id="grafico-proveedor" class="grafico">
         <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT proveedores.razon FROM proveedores ORDER BY proveedores.razon";
    
    $ConsultaGrafico = "
        SELECT
            proveedores.razon,
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto' 
        FROM
            ventas_detalle,
            articulos, 
            proveedores,
            ventas 
        WHERE
            ventas_detalle.venta IN (
                SELECT
                    ventas.codigo
                FROM
                    ventas
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'  
            )  
            AND
            ventas_detalle.venta = ventas.codigo
            AND
            ventas_detalle.articulo = articulos.codigo
            AND
            articulos.proveedor = proveedores.codigo  
        GROUP BY
            proveedores.razon
        ORDER BY
            monto DESC";
    
    $IdGrafico = 'grafico-proveedor';
    
    $TituloGrafico = 'Ventas realizadas por proveedor';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto de las ventas';
    
    include_once('include/grafico_barras.php');
    
?>

<div>
    
    <div id="torta-categoria" class="grafico">
         <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT categorias.categoria FROM categorias ORDER BY categorias.categoria";
    
    $ConsultaGrafico = "
        SELECT
            categorias.categoria,
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto'
        FROM
            ventas_detalle,
            articulos,
            categorias
        WHERE
            ventas_detalle.venta IN (
                SELECT
                    ventas.codigo
                FROM
                    ventas
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            )  
            AND
            ventas_detalle.articulo = articulos.codigo
            AND
            articulos.categoria = categorias.codigo  
        GROUP BY
            categorias.categoria
        ORDER BY
            monto DESC";
    
    $IdGrafico = 'torta-categoria';
    
    $TituloGrafico = 'Ventas por categoría';
    
    $TituloData = 'Monto de las ventas';
    
    include_once('include/grafico_torta.php');
    
?>

<div>
    
    <div id="torta-cliente" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT clientes.razon FROM clientes ORDER BY clientes.razon";
    
    $ConsultaGrafico = "
        SELECT
            clientes.razon,
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto' 
        FROM
            ventas_detalle,
            clientes,
            ventas 
        WHERE
            ventas_detalle.venta IN (
                SELECT
                    ventas.codigo
                FROM
                    ventas
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'  
            )  
            AND
            ventas_detalle.venta = ventas.codigo
            AND
            ventas.cliente = clientes.codigo  
        GROUP BY
            clientes.razon
        ORDER BY
            monto DESC";
    
    $IdGrafico = 'torta-cliente';
    
    $TituloGrafico = 'Ventas por cliente';
    
    $TituloData = 'Monto de las ventas';
    
    include_once('include/grafico_torta.php');
    
?>

<div>
    
    <div id="torta-articulo" class="grafico">
         <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT articulos.descripcion FROM articulos ORDER BY articulos.descripcion";
    
    $ConsultaGrafico = "
        SELECT
            articulos.descripcion,
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto'
        FROM
            ventas_detalle,
            articulos
        WHERE
            ventas_detalle.venta IN (
                SELECT
                    ventas.codigo
                FROM
                    ventas
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
            )  
            AND
            ventas_detalle.articulo = articulos.codigo
        GROUP BY
            articulos.descripcion 
        ORDER BY
            monto DESC";
    
    $IdGrafico = 'torta-articulo';
    
    $TituloGrafico = 'Ventas por articulo';
    
    $TituloData = 'Monto de las ventas';
    
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
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto' 
        FROM
            ventas_detalle,
            articulos, 
            proveedores,
            ventas 
        WHERE
            ventas_detalle.venta IN (
                SELECT
                    ventas.codigo
                FROM
                    ventas
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00'
                    AND
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'  
            )  
            AND
            ventas_detalle.venta = ventas.codigo
            AND
            ventas_detalle.articulo = articulos.codigo
            AND
            articulos.proveedor = proveedores.codigo  
        GROUP BY
            proveedores.razon
        ORDER BY
            monto DESC";
    
    $IdGrafico = 'torta-proveedor';
    
    $TituloGrafico = 'Ventas por proveedor';
    
    $TituloData = 'Monto de las ventas';
    
    include_once('include/grafico_torta.php');
    
?>

<div>
    
    <div id="promedio-ventas" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $ConsultaGrafico = "
        SELECT
            DATE_FORMAT(ventas.fecha, '%w') 'dia',
            SUM(ventas.monto)
        FROM
            ventas 
        WHERE
            ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
            AND 
            ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59' 
        GROUP BY
            dia
        ORDER BY
            dia";

    $IdGrafico = "promedio-ventas";
    
    $TituloGrafico = 'Ventas realizadas por día de la semana';
    
    $TituloEjeY = 'Monto';
    
    $TituloData = 'Monto de las ventas';
    
    include_once('include/grafico_barras_dia.php');
    
?>

<div>
    
    <div id="total-ventas" class="totales-informe total-izquierda">
    
        <h3 class="titulo-total">Total de ventas</h3>
        
        <?php

            $ConsultaGrafico = "
                SELECT
                    SUM(ventas.monto)
                FROM
                    ventas 
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);

            $Row = mysql_fetch_array($Result);
            
            $TotalVentas = $Row[0];

            print '<h1>$'.$TotalVentas.'</h1>';

        ?>
        
    </div>
    
</div>

<div>
    
    <div id="total-deuda" class="totales-informe total-derecha">
    
        <h3 class="titulo-total">Saldo de ventas</h3>
        
        <?php

            $ConsultaGrafico = "
                SELECT
                    SUM(ventas.saldo)
                FROM
                    ventas 
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);

            $Row = mysql_fetch_array($Result);

            print '<h1>$'.$Row[0].'</h1>';

        ?>
        
    </div>
    
</div>

<div>
    
    <div id="promedio-ventas" class="totales-informe total-izquierda">
    
        <h3 class="titulo-total">Promedio de ventas</h3>
        
        <?php
        
            $FechaInicio = strtotime(date(rotateDate($_REQUEST['fecha-inicio'])));
            $FechaFin = strtotime(date(rotateDate($_REQUEST['fecha-fin'])));

            $Intervalo = $FechaFin - $FechaInicio;

            $ConsultaGrafico = "
                SELECT
                    SUM(ventas.monto)
                FROM
                    ventas 
                WHERE
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);

            $Row = mysql_fetch_array($Result);

            print '<h1>$'.number_format($Row[0] / $Intervalo / (24*60*60), 2).' por día</h1>';

        ?>
        
    </div>
    
</div>

<div>
    
    <div id="promedio-cobros" class="totales-informe total-derecha">
    
        <h3 class="titulo-total">Promedio de cobros</h3>
        
        <?php

            $ConsultaGrafico = "
                SELECT  
                    SUM(cobros.monto)
                FROM 
                    cobros, 
                    ventas 
                WHERE 
                    cobros.operacion = ventas.codigo 
                    AND 
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);

            $Row = mysql_fetch_array($Result);
            
            print '<h1>$'.number_format($Row[0] / $Intervalo / (24*60*60), 2).' por día</h1>';

        ?>
        
    </div>
    
</div>

<div>
    
    <div id="total-utilidades" class="totales-informe total-izquierda">
    
        <h3 class="titulo-total">Utilidades</h3>
        
        <?php

            $ConsultaGrafico = "
                SELECT
                    SUM(ventas_detalle.precio - articulos.costo)
                FROM
                    ventas,
                    ventas_detalle,
                    articulos 
                WHERE 
                    articulos.codigo = ventas_detalle.articulo 
                    AND 
                    ventas_detalle.venta = ventas.codigo 
                    AND 
                    ventas.fecha >= '".rotateDate($_REQUEST['fecha-inicio'])." 00:00:00' 
                    AND 
                    ventas.fecha <= '".rotateDate($_REQUEST['fecha-fin'])." 23:59:59'";

            $Result = mysql_query($ConsultaGrafico);

            $Row = mysql_fetch_array($Result);
            
            $Utilidad = $Row[0];
            
            print '<h1>$'.$Utilidad.'</h1>';

        ?>
        
    </div>
    
</div>

<div>
    
    <div id="promedio-utilidades" class="totales-informe total-derecha">
    
        <h3 class="titulo-total">Porcentaje de utilidad</h3>
        
        <?php
            
            print '<h1>'.round($Utilidad / $TotalVentas * 100, 2).'%</h1>';

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
                SUM(ventas_detalle.cantidad)
            FROM
                articulos,
                categorias,
                proveedores,
                ventas_detalle,
                ventas 
            WHERE
                articulos.categoria = categorias.codigo
                AND
                articulos.proveedor = proveedores.codigo
                AND 
                articulos.codigo = ventas_detalle.articulo
                AND
                ventas.codigo = ventas_detalle.venta
                AND
                ventas.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00' 
                AND
                ventas.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
            GROUP BY
                ventas_detalle.articulo 
            ORDER BY
                ventas_detalle.cantidad DESC
            LIMIT
                0, 10";

        $Result = mysql_query($query);

        if (!$Result) {
            sql_error_msg();
            return;
        }

        if (mysql_numrows($Result) > 0) {

            print '<h2 class="titulo-grafico">Los diez artículos más vendidos</h2>';

            print '<div id="mas-vendidos" class="lista-tabla">';

            $i = 0;
            $Data = array();

            while ($Row = mysql_fetch_array($Result)) {
                $Data[$i]['codigo'] = $Row[0];
                $Data[$i]['descripcion'] = $Row[1];
                $Data[$i]['categoria'] = $Row[2];
                $Data[$i]['proveedor'] = $Row[3];
                $Data[$i]['cantidad'] = $Row[4];
                $Data[$i]['porcentaje'] = 0;
                $i++;
            }

            $query = "
                SELECT
                    SUM(ventas_detalle.cantidad)
                FROM
                    ventas, 
                    ventas_detalle 
                WHERE
                    ventas_detalle.venta = ventas.codigo 
                    AND 
                    ventas.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00'
                    AND
                    ventas.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59'";

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
                        <th>Cantidad</th>
                        <th>Porcentaje</th>
                    </tr>
                </thead>
                <tbody>';

            for ($i = 0; $i < sizeof($Data); $i++) {
                $Data[$i]['porcentaje'] = number_format($Data[$i]['cantidad'] / $Row[0] * 100, 2);
                $Data[$i]['cantidad'] = $Data[$i]['cantidad'];
                $Data[$i]['porcentaje'] = $Data[$i]['porcentaje'].'%';
                $Tabla .= '<tr class="';
                $i % 2 == 0 ? $Tabla .= "even" : $Tabla .= "odd";
                $Tabla .= '">
                        <td width="15%">'.$Data[$i]['codigo'].'</td>
                        <td width="35%">'.$Data[$i]['descripcion'].'</td>
                        <td width="15%">'.$Data[$i]['categoria'].'</td>
                        <td width="15%">'.$Data[$i]['proveedor'].'</td>
                        <td align="right" width="10%">'.$Data[$i]['cantidad'].'</td>
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
    
    <div id="torta-vendidos" class="grafico">
         <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $EtiquetasGrafico = "SELECT descripcion FROM articulos ORDER BY descripcion";
    
    $ConsultaGrafico = "
        SELECT
            articulos.descripcion,
            SUM(ventas_detalle.cantidad)
        FROM
            articulos,
            ventas_detalle,
            ventas 
        WHERE 
            articulos.codigo = ventas_detalle.articulo
            AND
            ventas.codigo = ventas_detalle.venta
            AND
            ventas.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00' 
            AND
            ventas.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
        GROUP BY
            ventas_detalle.articulo 
        ORDER BY
            ventas_detalle.cantidad DESC
        LIMIT
            0, 10";
    
    $IdGrafico = 'torta-vendidos';
    
    $TituloGrafico = 'Artículos más vendidos';
    
    $TituloData = 'Cantidad vendida';
    
    include_once('include/grafico_torta.php');
    
?>

<div>
    
    <?php

        $query = "
            SELECT
                LPAD(articulos.codigo, 12, 0),
                articulos.descripcion,
                categorias.categoria,
                proveedores.razon,
                SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto'
            FROM
                articulos,
                categorias,
                proveedores,
                ventas_detalle,
                ventas 
            WHERE
                articulos.categoria = categorias.codigo
                AND
                articulos.proveedor = proveedores.codigo
                AND 
                articulos.codigo = ventas_detalle.articulo
                AND
                ventas.codigo = ventas_detalle.venta
                AND
                ventas.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00' 
                AND
                ventas.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
            GROUP BY
                ventas_detalle.articulo 
            ORDER BY
                monto DESC
            LIMIT
                0, 10";

        $Result = mysql_query($query);

        if (!$Result) {
            print mysql_error();
            return;
        }

        if (mysql_numrows($Result) > 0) {
            
            print '<h2 class="titulo-grafico">Los diez artículos de mayor facturación</h2>';
    
            print '<div id="mas-ventas" class="lista-tabla">';

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
                    SUM(ventas.monto)
                FROM
                    ventas 
                WHERE
                    ventas.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00'
                    AND
                    ventas.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59'";

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
    
    <div id="torta-facturados" class="grafico">
        <!--  AQUI VA EL GRAFICO GENERADO  -->
    </div>
    
</div>

<?php

    $ConsultaGrafico = "
        SELECT
            articulos.descripcion,
            SUM(ventas_detalle.cantidad * ventas_detalle.precio) 'monto'
        FROM
            articulos,
            ventas_detalle,
            ventas 
        WHERE 
            articulos.codigo = ventas_detalle.articulo
            AND
            ventas.codigo = ventas_detalle.venta
            AND
            ventas.fecha >= '".date('Y-m-d', $FechaInicio)." 00:00:00' 
            AND
            ventas.fecha <= '".date('Y-m-d', $FechaFin)." 23:59:59' 
        GROUP BY
            ventas_detalle.articulo 
        ORDER BY
            monto DESC
        LIMIT
            0, 10";
    
    $IdGrafico = 'torta-facturados';
    
    $TituloGrafico = 'Articulos más facturados';
    
    $TituloData = 'Monto facturado';
    
    include_once('include/grafico_torta.php');
    
?>