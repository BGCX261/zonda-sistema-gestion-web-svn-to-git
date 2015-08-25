
<form class="formulario_busqueda" action="" method="GET">

    <input type="hidden" name="include" value="<?php print $_REQUEST['include']; ?>" />
    <input type="hidden" name="form" value="<?php print $_REQUEST['form']; ?>" />
    
    <p>
        
        <label>Filtrar por:</label>
        
        <select id="filtro_informe" name="filtro" class="text ui-widget-content ui-corner-all">
        <?php    
            foreach($Opciones as $Opcion) {
                print '<option value="'.$Opcion['valor'].'"';
                if (isset($_REQUEST['filtro']) && $_REQUEST['filtro'] == $Opcion['valor']) {
                    print ' selected="selected"';
                }
                print '>'.$Opcion['nombre'].'</option>';
            }
        ?>
        </select>
        
        <select id="comparacion_informe" name="comparacion" class="text ui-widget-content ui-corner-all">
            <option value="<"
            <?php
                if (isset($_REQUEST['comparacion']) && $_REQUEST['comparacion'] == '<')
                    print ' selected="selected"';
            ?>
            >menor a</option>
            <option value="="
            <?php
                if (isset($_REQUEST['comparacion']) && $_REQUEST['comparacion'] == '=')
                    print ' selected="selected"';
            ?>
            >igual a</option>
            <option value=">"
            <?php
                if (isset($_REQUEST['comparacion']) && $_REQUEST['comparacion'] == '>')
                    print ' selected="selected"';
            ?>
            >mayor a</option>
            <option value="LIKE"
            <?php
                if (isset($_REQUEST['comparacion']) && $_REQUEST['comparacion'] == 'LIKE')
                    print ' selected="selected"';
            ?>
            >empieza con</option>
        </select>
        
        <input type="text" id="filtro_informe_value" name="valor" class="text ui-widget-content ui-corner-all"
        <?php
            if (isset($_REQUEST['valor'])) {
                print ' value="'.$_REQUEST['valor'].'" ';
            }
        ?>
        />
        
    </p>
    
    <p>
        
        <label>Orden:</label>
    
        <select id="orden_informe" name="orden" class="text ui-widget-content ui-corner-all">
        <?php    
            foreach($Opciones as $Opcion) {
                print '<option value="'.$Opcion['valor'].'"';
                if (isset($_REQUEST['orden']) && $_REQUEST['orden'] == $Opcion['valor']) {
                    print ' selected="selected"';
                }
                print '>'.$Opcion['nombre'].'</option>';
            }
        ?>
        </select>
        
    </p>
    
    <p>
        
        <label>Dirección:</label>
        
        <select id="direccion_informe" name="direccion" class="text ui-widget-content ui-corner-all">
            <option value="ASC"
            <?php
                if (isset($_REQUEST['direccion']) && $_REQUEST['direccion'] == 'ASC')
                    print ' selected="selected"';
            ?>
            >Ascendente</option>
            <option value="DESC"
            <?php
                if (isset($_REQUEST['direccion']) && $_REQUEST['direccion'] == 'DESC')
                    print ' selected="selected"';
            ?>
            >Descendente</option>
        </select>
    
    </p>

    <p>
        
        <label>Desde:</label>
        <input type="text" id="fecha-inicio" name="fecha-inicio" class="fecha text ui-widget-content ui-corner-all" value="<?php print $_REQUEST['fecha-inicio']; ?>" >
        
        <label>Hasta:</label>
        <input type="text" id="fecha-fin" name="fecha-fin" class="fecha text ui-widget-content ui-corner-all" value="<?php print $_REQUEST['fecha-fin']; ?>" >
        
    </p>
    
    <input type="submit" id="generar_informe" value="Aceptar" />
    
</form>
