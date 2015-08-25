<?php

    $query = "
        SELECT
            listas_precio_detalle.articulo,
            articulos.descripcion,
            listas_precio_detalle.precio
        FROM 
            listas_precio_detalle,
            articulos
        WHERE 
            listas_precio_detalle.articulo = articulos.codigo
            AND 
            articulos.codigo = ".$_REQUEST['codigo']."
            AND
            listas_precio_detalle.lista = ".$_REQUEST['lista'];
    
    $Result = mysql_query($query);
    $Registro = mysql_fetch_array($Result);
    
?>

<h1>Editar un precio de la lista</h1>

<p id="mensaje-error">Complete los campos para continuar</p>

<form class="formulario" action="" method="GET">

    <input type="hidden" name="include" value="articulos" />
    <input type="hidden" name="action" value="modificar_precio" />
    <input type="hidden" name="lista" value="<?php print $_REQUEST['lista']; ?>" />

    <fieldset>

        <label>Artículo:</label>
        <input type="text" id="articulo" name="articulo" size="11" maxlength="11" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[0]; ?>" readonly="readonly" />

        <label>Descripción:</label>
        <input type="text" id="descripcion" size="30" maxlength="50" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[1]; ?>" readonly="readonly" />

        <label>Precio:</label>
        <input type="text" id="precio" name="precio" size="10" maxlength="10" class="text ui-widget-content ui-corner-all" value="<?php print $Registro[2]; ?>" />

    </fieldset>
    
    <input type="submit" value="Aceptar" class="ui-button ui-widget-content ui-corner-all" />

</form>
