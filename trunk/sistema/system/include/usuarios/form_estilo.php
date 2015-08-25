
<h1>Cambiar estilo</h1>

<p>Seleccione el estilo que desea utilizar, presione el botón de aceptar y, a continuación, pulse el botón actualizar de su navegador.</p>

<form class="formulario" action="" method="GET">

    <input type="hidden" name="include" value="usuarios" />
    <input type="hidden" name="action" value="cambiar_estilo" />
    
    <fieldset>
        
        <label>Estilos disponibles:</label>
        <select id="estilo" name="estilo" class="text ui-widget-content ui-corner-all">
            <?php
                $Result = mysql_query("SELECT codigo, nombre FROM estilos"); 
                if (!$Result) {
                    print '</select>';
                    print '<script>';
                    print '$("#panel").html("");';
                    print 'alert("No hay estilos disponibles en el sistema!");';
                    print '</script>';
                    return;
                }
                while($Row = mysql_fetch_array($Result)) {
                    print '<option value="'. $Row[0] .'">'. $Row[1] .'</option>';
                }
            ?>
        </select>
        
    </fieldset>
        
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" />
    
</form>
