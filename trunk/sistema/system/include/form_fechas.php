
<form class="formulario_busqueda" action="" method="GET">

    <input type="hidden" name="include" value="<?php print $_REQUEST['include']; ?>" />
    <input type="hidden" name="form" value="<?php print $_REQUEST['form']; ?>" />
    
    <p>
        
        <label>Desde:</label>
        <input type="text" id="fecha-inicio" name="fecha-inicio" class="fecha text ui-widget-content ui-corner-all" value="<?php print $_REQUEST['fecha-inicio']; ?>" >
        
    </p>
    <p>
        
        <label>Hasta:</label>
        <input type="text" id="fecha-fin" name="fecha-fin" class="fecha text ui-widget-content ui-corner-all" value="<?php print $_REQUEST['fecha-fin']; ?>" >
        
    </p>
    
    <input type="submit" id="generar_informe" value="Aceptar" />
    
</form>
