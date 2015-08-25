<?php

    $query = "
        SELECT
            LPAD(compras.codigo, 11, 0),
            DATE_FORMAT(compras.fecha, '%d-%m-%Y %H:%i:%s'),
            proveedores.razon,
            compras.monto,
            compras.saldo   
        FROM
            compras,
            proveedores
        WHERE
            compras.proveedor = proveedores.codigo AND
            compras.codigo = ".$_REQUEST['codigo'];
    
    $Result = mysql_query($query);
    
    if (!$Result) {
        print 'alert("No hay compras registradas en el sistema!");';
        return;
    }
                
    $Registro = mysql_fetch_array($Result);
    
?>

<h1>Realizar un pago de factura</h1>

<p id="mensaje-error">El pago puede ser por el total o parte del saldo de la factura</p>

<form class="formulario" action="" method="GET">
    
    <input type="hidden" name="include" value="proveedores" />
    <input type="hidden" name="action" value="pago" />

    <fieldset>

        <label>Código de la factura:</label>
        <input type="text" id="codigo" name="codigo" size="11" maxlength="11" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[0]; ?>" readonly="readonly" />

        <label>Fecha de emisión:</label>
        <input type="text" id="fecha" size="30" maxlength="30" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[1]; ?>" readonly="readonly" />

        <label>Razón social del proveedor:</label>
        <input type="text" id="razon" size="50" maxlength="50" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[2]; ?>" readonly="readonly" />

        <label>Monto de la factura:</label>
        <input type="text" id="monto" size="8" maxlength="8" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[3]; ?>" readonly="readonly" />

        <label>Saldo de la factura:</label>
        <input type="text" id="saldo" size="8" maxlength="8" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[4]; ?>" readonly="readonly" />

        <label>Monto a pagar:</label>
        <input type="text" id="pago" name="pago" size="8" maxlength="8" class="text ui-widget-content ui-corner-all" value="0" />

        <label>A acreditar en el fondo:</label>
        <select id="fondo" name="fondo" class="text ui-widget-content ui-corner-all">
            <?php
                $Result = mysql_query("SELECT codigo, descripcion FROM fondos ORDER BY descripcion");
                if (!$Result) {
                    print '</select>';
                    print '<script>';
                    print '$("#panel").html("");';
                    print 'alert("No hay fondos registrados en el sistema!");';
                    print '</script>';
                    return;
                }
                while ($Row = mysql_fetch_array($Result)) {
                    print '<option value="'.$Row[0].'">'.$Row[1].'</option>';
                }
            ?>
        </select>

    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" />

</form>