
<h1>Dar de alta un proveedor</h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" action="" method="GET">
    
    <input type="hidden" name="include" value="proveedores" />
    <input type="hidden" name="action" value="alta" />

    <fieldset>

        <label>Código:</label>
        <input type="text" id="codigo" name="codigo" size="11" maxlength="11" class="text ui-widget-content ui-corner-all" value="<?php
                $Result = mysql_query("SELECT MAX(codigo) + 1 FROM proveedores");
                if (!$Result) {
                    print '</select>';
                    print '<script>';
                    print '$("#panel").html("");';
                    print 'alert("No hay proveedores registrados en el sistema!");';
                    print '</script>';
                    return;
                }
                $Row = mysql_fetch_array($Result);
                $Row[0] == "" ? print "1" : print $Row[0];
            ?>"/>

        <label>Razón social:</label>
        <input type="text" id="razon" name="razon" size="50" maxlength="50" class="text ui-widget-content ui-corner-all" />

        <label>Domicilio:</label>
        <input type="text" id="domicilio" name="domicilio" size="50" maxlength="50" class="text ui-widget-content ui-corner-all" />

        <label>Teléfono:</label>
        <input type="text" id="telefono" name="telefono" size="20" maxlength="20" class="text ui-widget-content ui-corner-all" />

        <label>Localidad:</label>
        <select id="localidad" name="localidad" class="text ui-widget-content ui-corner-all">
            <?php
                $Result = mysql_query("SELECT codigo, localidad FROM localidades ORDER BY localidad");
                if (!$Result) {
                    print '</select>';
                    print '<script>';
                    print '$("#panel").html("");';
                    print 'alert("No hay localidades registradas en el sistema!");';
                    print '</script>';
                    return;
                }
                while ($Row = mysql_fetch_array($Result)) {
                   print '<option value="'.$Row[0].'">'.$Row[1].'</option>';
                }
            ?>
        </select>

        <label>Página:</label>
        <input type="text" id="pagina" name="pagina" size="30" maxlength="30" class="text ui-widget-content ui-corner-all" />

        <label>Correo:</label>
        <input type="text" id="correo" name="correo" size="30" maxlength="30" class="text ui-widget-content ui-corner-all" />

        <label>Saldo:</label>
        <input type="text" id="saldo" name="saldo" size="8" maxlength="8" class="text ui-widget-content ui-corner-all" value="0.00" />

    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" onclick="return validarCamposFormClientes();" />

</form>
