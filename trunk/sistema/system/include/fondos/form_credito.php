 
<h1>Acreditar a un fondo de caja</h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" method="GET">

    <input type="hidden" name="include" value="fondos" />
    <input type="hidden" name="action" value="credito" />

    <fieldset>

        <label>Fondo:</label>

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

        <label>Monto:</label>

        <input type="text" id="monto" name="monto" size="8" maxlength="8" class="text ui-widget-content ui-corner-all" />

        <label>Concepto:</label>

        <textarea id="concepto" name="concepto" class="text ui-widget-content ui-corner-all"></textarea>

    </fieldset>

    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" onclick="return validarCamposFormCreditoDebito();" />

</form>
