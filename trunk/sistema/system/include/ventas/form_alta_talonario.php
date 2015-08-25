<?php
    
?>    
<h1>Agregar un talonario</h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" action="" method="GET">

    <input type="hidden" name="include" value="ventas" />
    <input type="hidden" name="action" value="alta_talonario" />
    
    <fieldset>

        <label>Código:</label>
        <input type="text" id="codigo" name="codigo" size="11" maxlength="11" class="text ui-widget-content ui-corner-all" value="<?php
                $Result = mysql_query("SELECT MAX(codigo) + 1 FROM talonarios");
                $Codigo = 1;
                $Row = mysql_fetch_array($Result);
                if ($Row[0] != NULL) {
                    $Codigo = $Row[0];
                }
                print $Codigo;
            ?>" readonly="readonly" />

        <label>Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" size="30" maxlength="50" class="text ui-widget-content ui-corner-all" />

        <label>Inicio de la numeración:</label>
        <input type="text" id="inicio-talonario" name="inicio" size="30" maxlength="50" class="text ui-widget-content ui-corner-all" />

        <label>Numeración actual:</label>
        <input type="text" id="actual" name="actual" size="30" maxlength="50" class="text ui-widget-content ui-corner-all" />

    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" />
    
</form>
