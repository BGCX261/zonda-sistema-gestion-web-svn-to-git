<?php
    include_once('conexion.php');
    $Result = mysql_query("
        SELECT
            usuarios_registro.codigo,
            usuarios.apodo,
            DATE_FORMAT(usuarios_registro.fecha, '%d/%m/%Y'),
            DATE_FORMAT(usuarios_registro.fecha, '%H:%i:%S'),
            usuarios_registro.ip
        FROM
            usuarios,
            usuarios_registro
        WHERE
            usuarios.codigo = usuarios_registro.usuario
        ORDER BY
            usuarios_registro.codigo DESC
    ");
    $Row = mysql_fetch_array($Result);
?>
<h1>Bienvenido al sistema!</h1>
<br />
<p>La &uacute;ltma conexi&oacute;n la realiz&oacute; <?php print $Row[1]; ?> el d&iacute;a <?php print $Row[2]; ?> a las <?php print $Row[3]; ?> desde <?php print $Row[4]; ?></p>
<?php
    $Result = mysql_query("
        SELECT
            (SELECT
                COUNT(*)
            FROM
                articulos
            WHERE
                existencia < 1),
            (SELECT
                COUNT(*)
            FROM
                articulos)
    ");
    $Row = mysql_fetch_array($Result);
    if ($Row[1] == 0) {
?>
<p>No hay art&iacute;culos ingresados en el sistema.</p>
<?php
    }
    else {
?>
<p>En este momento hay <?php print $Row[0]; ?> art&iacute;culos faltantes en stock de un total de <?php print $Row[1]; ?> (<?php print round($Row[0] / $Row[1] * 100, 0); ?>% del stock faltante)</p>
<?php
    }
    $Result = mysql_query("
        SELECT
            COUNT(*)
        FROM
            pedidos
        WHERE
            procesado < 1
    ");
    $Row = mysql_fetch_array($Result);
    if ($Row[0] == 0) {
?>
<p>No hay pedidos pendientes.</p>
<?php
    }
    else {
?>
<p>Hay <?php print $Row[0]; ?> pedido<?php if ($Row[0] > 1) print 's'; ?> pendiente<?php if ($Row[0] > 1) print 's'; ?></p>
<?php
    }
    $Result = mysql_query("
        SELECT
            COUNT(*)
        FROM
            clientes
    ");
    $Row = mysql_fetch_array($Result);
    if ($Row[0] == 0) {
        print '<p>No hay clientes registrados en el sistema.</p>';
    }
    else {
        $Result = mysql_query("
            SELECT
                razon
            FROM
                clientes
            WHERE
                saldo > 0
        ");
        if (mysql_num_rows($Result) > 0) {
            print '<p>Los siguientes clientes presentan saldo deudor:<ul>';
            while($Row = mysql_fetch_array($Result)) {
                print '<li>'.$Row[0].'</li>';
            }
            print '</ul></p>';
        }
        else {
            print '<p>No hay clientes con saldo deudor.</p>';
        }
    }
    $Result = mysql_query("
        SELECT
            COUNT(*)
        FROM
            proveedores
    ");
    $Row = mysql_fetch_array($Result);
    if ($Row[0] == 0) {
        print '<p>No hay proveedores registrados en el sistema.</p>';
    }
    else {
        $Result = mysql_query("
            SELECT
                razon
            FROM
                proveedores
            WHERE
                saldo > 0
        ");
        if (mysql_num_rows($Result) > 0) {
            print '<p>Hay facturas por pagar de los siguientes proveedores:<ul>';
            while($Row = mysql_fetch_array($Result)) {
                print '<li>'.$Row[0].'</li>';
            }
            print '</ul></p>';
        }
        else {
            print '<p>No hay cuentas por pagar de proveedores.</p>';
        }
    }
?>