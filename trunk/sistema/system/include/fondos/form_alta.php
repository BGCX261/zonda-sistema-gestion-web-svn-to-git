
<h1>Dar de alta un fondo</h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" method="GET">
    
    <input type="hidden" name="include" value="fondos" />
    <input type="hidden" name="action" value="alta" />

    <fieldset>

        <label>Código:</label>
        <input type="text" id="codigo" name="codigo" size="11" maxlength="11" class="text ui-widget-content ui-corner-all" value="<?php
                $Result = mysql_query("SELECT MAX(codigo) + 1 FROM fondos");
                if (!$Result) {
                    print '</select>';
                    print '<script>';
                    print '$("#panel").html("");';
                    print 'alert("No hay fondos registrados en el sistema!");';
                    print '</script>';
                    return;
                }
                $Row = mysql_fetch_array($Result);
                $Row[0] == "" ? print "1" : print $Row[0];
            ?>" readonly="readonly" />

        <label>Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" size="30" maxlength="50" class="text ui-widget-content ui-corner-all" />

        <label>Saldo:</label>
        <input type="text" id="saldo" name="saldo" size="8" maxlength="8" class="text ui-widget-content ui-corner-all" value="0" />

    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" onclick="return validarCamposFormFondos()" />

</form>