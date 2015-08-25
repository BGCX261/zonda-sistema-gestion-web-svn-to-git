<?php
    $query = "SELECT * FROM talonarios WHERE codigo = ".$_REQUEST["codigo"];
    $Result = mysql_query($query);
    $Registro = mysql_fetch_array($Result);
?>    

<h1>Editar un talonario</h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario">

    <input type="hidden" name="include" value="ventas" />
    <input type="hidden" name="action" value="edicion_talonario" />
    
    <fieldset>

        <label>Código:</label>
        <input type="text" id="codigo" name="codigo" size="11" maxlength="11" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[0]; ?>" readonly="readonly" />

        <label>Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" size="30" maxlength="50" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[1]; ?>" />

        <label>Inicio de la numeración:</label>
        <input type="text" id="inicio-talonario" name="inicio" size="30" maxlength="50" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[3]; ?>" />

        <label>Numeración actual:</label>
        <input type="text" id="actual" name="actual" size="30" maxlength="50" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[4]; ?>" />

    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" />

</form>
