
<?php
    $query = "SELECT codigo, descripcion, existencia FROM articulos WHERE codigo = ".$_REQUEST["codigo"];
    $Result = mysql_query($query);
    $Registro = mysql_fetch_array($Result);
?>    

<h1>Ajustar un registro de artículo</h1>

<p id='mensaje-error'>Complete los campos para continuar</p>

<form class='formulario' action="" method="GET">

    <input type="hidden" name="include" value="articulos" />
    <input type="hidden" name="action" value="ajuste" />

    <fieldset>
        
        <label>Código:</label>
        <input type='text' id='codigo' name='codigo' size="13" maxlength="13" class='text ui-widget-content ui-corner-all' value='<?php print $Registro[0]; ?>' readonly='readonly'/>
        
        <label>Descripción:</label>
        <input type='text' id='descripcion' name='descripcion' size='30' maxlength='50' class='text ui-widget-content ui-corner-all' value='<?php print $Registro[1]; ?>' readonly='readonly'/>
        
        <label>Existencia:</label>
        <input type='text' id='existencia' name='existencia' size='8' maxlength='8' class='text ui-widget-content ui-corner-all' value='<?php print $Registro[2]; ?>' />
        
    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" />

</form>
